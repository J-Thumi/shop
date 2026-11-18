<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    private const STATUSES = [
        'pending',
        'confirmed',
        'processing',
        'ready_for_collection',
        'completed',
        'cancelled',
    ];

    public function updateStatus(
        Order $order,
        string $status,
        User $actor,
        ?string $note = null
    ): void {
        if (!in_array($status, self::STATUSES, true)) {
            throw ValidationException::withMessages([
                'status' => 'Invalid order status.',
            ]);
        }

        DB::transaction(function () use ($order, $status, $actor, $note) {
            $order = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->isTerminal()) {
                throw ValidationException::withMessages([
                    'status' => 'This order can no longer be changed.',
                ]);
            }

            if ($status === 'cancelled') {
                throw ValidationException::withMessages([
                    'status' => 'Use the cancellation approval process instead.',
                ]);
            }

            $allowed = [
                'pending' => ['confirmed', 'cancelled'],
                'confirmed' => ['processing', 'cancelled'],
                'processing' => ['ready_for_collection'],
                'ready_for_collection' => ['completed'],
            ];

            if (!in_array($status, $allowed[$order->status] ?? [], true)) {
                throw ValidationException::withMessages([
                    'status' => 'That status transition is not allowed.',
                ]);
            }

            $order->status = $status;

            if ($status === 'completed') {
                $order->completed_at = now();
                $order->payment_status = 'paid';
            }

            $order->save();

            $order->statusHistories()->create([
                'user_id' => $actor->id,
                'status' => $status,
                'note' => $note,
            ]);
        });
    }

    public function cancelByCustomer(
        Order $order,
        User $customer,
        string $reason
    ): string {
        return DB::transaction(function () use ($order, $customer, $reason) {
            $order = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->user_id !== $customer->id) {
                abort(403);
            }

            if ($order->canBeCancelledImmediately()) {
                $order->update([
                    'status' => 'cancelled',
                    'cancelled_at' => now(),
                ]);

                $order->statusHistories()->create([
                    'user_id' => $customer->id,
                    'status' => 'cancelled',
                    'note' => 'Cancelled by customer: ' . $reason,
                ]);

                return 'cancelled';
            }

            if ($order->canRequestCancellation()) {
                $order->cancellation()->create([
                    'requested_by' => $customer->id,
                    'reason' => $reason,
                    'status' => 'requested',
                ]);

                $order->statusHistories()->create([
                    'user_id' => $customer->id,
                    'status' => $order->status,
                    'note' => 'Customer requested cancellation: ' . $reason,
                ]);

                return 'requested';
            }

            throw ValidationException::withMessages([
                'reason' => 'This order cannot be cancelled at its current stage.',
            ]);
        });
    }

    public function reviewCancellation(
        Order $order,
        User $admin,
        bool $approve,
        ?string $adminNote = null
    ): void {
        DB::transaction(function () use ($order, $admin, $approve, $adminNote) {
            $order = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $cancellation = $order->cancellation;

            if (!$cancellation || $cancellation->status !== 'requested') {
                throw ValidationException::withMessages([
                    'cancellation' => 'There is no pending cancellation request.',
                ]);
            }

            if ($approve) {
                if (!in_array($order->status, [
                    'processing',
                    'ready_for_collection',
                ], true)) {
                    throw ValidationException::withMessages([
                        'cancellation' => 'The order can no longer be cancelled.',
                    ]);
                }

                $order->update([
                    'status' => 'cancelled',
                    'cancelled_at' => now(),
                ]);

                $order->statusHistories()->create([
                    'user_id' => $admin->id,
                    'status' => 'cancelled',
                    'note' => 'Cancellation approved. ' . ($adminNote ?? ''),
                ]);
            }

            $cancellation->update([
                'status' => $approve ? 'approved' : 'rejected',
                'reviewed_by' => $admin->id,
                'admin_note' => $adminNote,
                'reviewed_at' => now(),
            ]);
        });
    }
}