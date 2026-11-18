@extends('layouts.app', ['title' => 'Terms of Service — ' . config('app.name')])

@section('content')
<div x-data="{ activeSection: 'section-1' }" class="bg-paper min-h-screen">

    {{-- Header Banner --}}
    <div class="border-b border-line bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-soft border border-line text-xs font-bold text-ink mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                    Legal Documentation
                </div>

                <h1 class="font-display font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight text-ink mb-4">
                    Terms of Service
                </h1>

                <p class="text-sm sm:text-base text-muted leading-relaxed mb-6">
                    Please read these terms carefully before browsing products, placing an order or using the services provided by {{ config('app.name') }}.
                </p>

                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-medium text-muted pt-4 border-t border-line">
                    <div>
                        <span class="text-ink font-bold">Effective Date:</span> {{ now()->format('F j, Y') }}
                    </div>
                    <span class="hidden sm:inline text-line">•</span>
                    <div>
                        <span class="text-ink font-bold">Last Updated:</span> {{ now()->format('F j, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Layout: Sticky TOC + Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            {{-- Table of Contents --}}
            <aside class="hidden lg:block lg:col-span-4 sticky top-28">
                <div class="bg-white border border-line rounded-2xl p-6 shadow-sm">
                    <h2 class="font-display font-bold text-xs uppercase tracking-wider text-muted mb-4">
                        Table of Contents
                    </h2>

                    @php
                        $sections = [
                            '1. Introduction',
                            '2. Definitions',
                            '3. Eligibility and Accounts',
                            '4. Product Information',
                            '5. Orders and Order Acceptance',
                            '6. Prices, Taxes and Payments',
                            '7. Delivery and Collection',
                            '8. Returns, Exchanges and Refunds',
                            '9. Warranties and Product Support',
                            '10. Customer Responsibilities',
                            '11. Promotions and Discount Codes',
                            '12. Prohibited Activities',
                            '13. Intellectual Property',
                            '14. Third-Party Services',
                            '15. Platform Availability',
                            '16. Suspension and Termination',
                            '17. Limitation of Liability',
                            '18. Privacy and Personal Information',
                            '19. Changes to These Terms',
                            '20. Governing Law and Contact',
                        ];
                    @endphp

                    <nav class="space-y-1 max-h-[calc(100vh-14rem)] overflow-y-auto pr-2 text-xs">
                        @foreach($sections as $index => $label)
                            @php $id = 'section-' . ($index + 1); @endphp
                            <a href="#{{ $id }}"
                               @click="activeSection = '{{ $id }}'"
                               :class="activeSection === '{{ $id }}' ? 'bg-soft text-ink font-bold border-l-2 border-accent' : 'text-muted hover:text-ink hover:bg-soft/50'"
                               class="block px-3 py-2 rounded-r-lg transition-all">
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>

                    <div class="mt-6 pt-5 border-t border-line">
                        <p class="text-xs text-muted mb-3">Related legal document:</p>
                        <a href="{{ route('legal.privacy') }}"
                           class="inline-flex items-center justify-between w-full px-3.5 py-2.5 text-xs font-bold text-ink bg-soft hover:bg-line rounded-xl transition">
                            <span>Privacy Policy</span>
                            <svg class="w-4 h-4 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </aside>

            {{-- Document Body --}}
            <article class="lg:col-span-8 bg-white border border-line rounded-2xl p-6 sm:p-10 shadow-sm space-y-10 text-sm sm:text-[15px] text-[#3a3a40] leading-relaxed">

                {{-- 1. Introduction --}}
                <section id="section-1" x-intersect.margin.-20%="activeSection = 'section-1'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">01</span>
                        Introduction
                    </h2>
                    <p>Welcome to {{ config('app.name') }}.</p>
                    <p>{{ config('app.name') }} operates an ecommerce website through which customers can browse, enquire about and purchase products, including security equipment, CCTV systems, access control products, networking equipment, electrical supplies and other technology-related products offered on the website.</p>
                    <p>These Terms of Service ("Terms") govern your access to and use of the {{ config('app.name') }} website, your account and any orders or related services you use through the website.</p>
                    <p>In these Terms, "{{ config('app.name') }}", "we", "our" and "us" refer to the business operating this website.</p>
                    <p class="p-4 rounded-xl bg-soft border border-line text-ink font-medium text-xs sm:text-sm">
                        By accessing the website, creating an account or placing an order, you agree to these Terms. If you do not agree, please do not use the website or place an order.
                    </p>
                </section>

                <hr class="border-line">

                {{-- 2. Definitions --}}
                <section id="section-2" x-intersect.margin.-20%="activeSection = 'section-2'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">02</span>
                        Definitions
                    </h2>
                    <p>For purposes of these Terms:</p>
                    <ul class="space-y-2.5 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Website:</strong> The {{ config('app.name') }} ecommerce website and its related pages and services.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Customer or You:</strong> Any person or business that visits the website, creates an account, makes an enquiry or purchases products.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Products:</strong> Goods, equipment and related items displayed or offered for sale through the website.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Order:</strong> A request submitted by a customer to purchase one or more products.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Order Confirmation:</strong> A communication from us confirming that we have accepted an order, subject to any stated conditions.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Payment Provider:</strong> A bank, mobile money service or other third-party provider that processes a payment.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Business Day:</strong> A day other than a weekend or public holiday in Kenya, unless stated otherwise.</span></li>
                    </ul>
                </section>

                <hr class="border-line">

                {{-- 3. Eligibility and Accounts --}}
                <section id="section-3" x-intersect.margin.-20%="activeSection = 'section-3'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">03</span>
                        Eligibility and Accounts
                    </h2>
                    <p>You may browse the website without creating an account. Certain features, order tracking or purchasing functions may require an account.</p>
                    <p>When creating an account, you agree to provide accurate, current and complete information and to update it when necessary.</p>
                    <p>You are responsible for:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Keeping your login credentials confidential.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Providing accurate contact, billing and delivery information.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Notifying us promptly if you suspect unauthorised access to your account.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Activity carried out through your account, subject to applicable law and our own legal responsibilities.</span></li>
                    </ul>
                    <p>You must not impersonate another person, use another person's account without permission or create accounts for fraudulent purposes. We may restrict or suspend an account where we reasonably suspect misuse or a breach of these Terms.</p>
                </section>

                <hr class="border-line">

                {{-- 4. Product Information --}}
                <section id="section-4" x-intersect.margin.-20%="activeSection = 'section-4'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">04</span>
                        Product Information
                    </h2>
                    <p>We make reasonable efforts to ensure that product descriptions, images, specifications, prices and other information displayed on the website are accurate and up to date.</p>
                    <p>Product images are provided for illustration and identification. Actual products may differ slightly in appearance, packaging, colour or included accessories due to manufacturer updates, photography or supplier variations.</p>
                    <p>Technical specifications, compatibility information and stated features should be reviewed before placing an order. If a product is intended to work with existing equipment or infrastructure, you are responsible for checking compatibility or contacting us for clarification before purchase.</p>
                    <p>Unless expressly stated, product listings do not include installation, configuration, cabling, accessories or additional services that are not identified as part of the product or offer.</p>
                    <p>We may correct typographical errors, inaccurate descriptions, images or listing information. If a correction materially affects an order you have placed, we will take reasonable steps to contact you and explain the available options.</p>
                </section>

                <hr class="border-line">

                {{-- 5. Orders and Order Acceptance --}}
                <section id="section-5" x-intersect.margin.-20%="activeSection = 'section-5'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">05</span>
                        Orders and Order Acceptance
                    </h2>
                    <p>Submitting an order is an offer to purchase the selected products under the details and terms displayed at checkout.</p>
                    <p>An automated acknowledgement that we have received your order does not necessarily mean that the order has been accepted. An order is accepted when we issue an order confirmation or otherwise expressly confirm acceptance.</p>
                    <p>We may be unable to accept or fulfil an order where, for example:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>The product is unavailable or has been discontinued.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>A pricing, listing or stock error has occurred.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Payment cannot be verified or is declined.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>The delivery information is incomplete or cannot be serviced.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>We reasonably suspect fraud, unauthorised activity or a breach of these Terms.</span></li>
                    </ul>
                    <p>If we cannot accept an order after payment has been made, we will notify you and arrange an appropriate refund for the amount received, subject to applicable law and payment-provider procedures.</p>
                    <p>Please review your order carefully before submitting it. Contact us as soon as possible if you notice an error. We cannot guarantee that an order can be changed or cancelled after processing has begun.</p>
                </section>

                <hr class="border-line">

                {{-- 6. Prices, Taxes and Payments --}}
                <section id="section-6" x-intersect.margin.-20%="activeSection = 'section-6'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">06</span>
                        Prices, Taxes and Payments
                    </h2>
                    <p>Prices and applicable charges will be displayed on the website or communicated to you before you confirm an order. Unless stated otherwise, prices are quoted in Kenyan Shillings (KES).</p>
                    <p>Delivery charges, installation fees or other additional costs will be disclosed before you complete the relevant purchase where they apply.</p>
                    <p>We may update product prices from time to time. A price change will not, by itself, alter an order that we have already accepted.</p>
                    <p>Payments may be accepted through the payment methods made available at checkout, which may include mobile money, bank cards, bank transfers or other payment services. Payment processing may be subject to the provider's own terms and conditions.</p>
                    <p>An order may not be processed for dispatch until the required payment has been successfully confirmed, unless we have expressly agreed to another payment arrangement.</p>
                    <p>You must not submit false payment confirmations, reverse-engineer payment processes, exploit payment errors or attempt to obtain products without paying the amount due.</p>
                    <p>If a payment is deducted but the order is not confirmed, contact us with the transaction reference so that we can investigate. We will take reasonable steps to reconcile the payment with the relevant payment provider.</p>
                </section>

                <hr class="border-line">

                {{-- 7. Delivery and Collection --}}
                <section id="section-7" x-intersect.margin.-20%="activeSection = 'section-7'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">07</span>
                        Delivery and Collection
                    </h2>
                    <p>Available delivery methods, delivery areas, estimated timelines and applicable charges will be communicated during checkout or directly by our team.</p>
                    <p>Delivery estimates are provided in good faith but are not guaranteed unless we expressly agree otherwise. Delays may occur because of courier operations, weather, traffic, stock availability, public holidays or other circumstances beyond our reasonable control.</p>
                    <p>You are responsible for providing a complete and accurate delivery address and reachable contact details. Additional charges or delays may arise where delivery information is incorrect or a delivery attempt cannot be completed for reasons within your control.</p>
                    <p>You or an authorised recipient may be required to confirm receipt of an order. Please inspect the package at delivery and notify us promptly if it appears damaged, incomplete or incorrect.</p>
                    <p>Where collection is offered, we will communicate the collection location, readiness and any identification or order details required. Products should only be collected by the customer or a person authorised by the customer.</p>
                    <p>Any statutory rights relating to delivery, risk, ownership or defective goods remain unaffected by this section.</p>
                </section>

                <hr class="border-line">

                {{-- 8. Returns, Exchanges and Refunds --}}
                <section id="section-8" x-intersect.margin.-20%="activeSection = 'section-8'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">08</span>
                        Returns, Exchanges and Refunds
                    </h2>
                    <p>If you receive a product that is damaged, defective, incorrect or materially different from its description, contact us as soon as reasonably possible and provide your order details and relevant supporting information.</p>
                    <p>Depending on the circumstances and applicable law, an eligible issue may be resolved through repair, replacement, exchange, price adjustment or refund.</p>
                    <p>Where a change-of-mind return is offered, its eligibility, time limit, product condition requirements and any applicable costs will be communicated in the relevant returns policy or at the point of sale.</p>
                    <p>For hygiene, safety, software, customised, special-order or otherwise restricted products, additional return conditions may apply where permitted by law. Any such restrictions will be disclosed where applicable and will not remove rights that cannot legally be excluded.</p>
                    <p>Returned products may need to be accompanied by proof of purchase, original accessories, manuals and packaging, where reasonably required and permitted by law.</p>
                    <p>Approved refunds will generally be made through the original payment method where practicable. Processing times may depend on the payment provider or financial institution.</p>
                    <p>Nothing in these Terms limits consumer rights or remedies available under applicable Kenyan law.</p>
                </section>

                <hr class="border-line">

                {{-- 9. Warranties and Product Support --}}
                <section id="section-9" x-intersect.margin.-20%="activeSection = 'section-9'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">09</span>
                        Warranties and Product Support
                    </h2>
                    <p>Some products may be supplied with a manufacturer's warranty, seller warranty or other product-specific guarantee. The applicable warranty provider, duration, coverage and claim process will be communicated where that information is available.</p>
                    <p>Warranty coverage may be subject to the manufacturer's or warranty provider's terms. You should retain proof of purchase and any warranty documentation supplied with the product.</p>
                    <p>Unless expressly included in the product listing or separately agreed in writing, the purchase of equipment does not automatically include installation, maintenance, configuration, on-site support or technical training.</p>
                    <p>Warranty claims may require inspection or assessment. We may guide you through the relevant process, but a manufacturer's warranty decision may be made by the manufacturer or its authorised service provider.</p>
                    <p>Nothing in this section excludes any warranty, guarantee or consumer protection that must apply under law.</p>
                </section>

                <hr class="border-line">

                {{-- 10. Customer Responsibilities --}}
                <section id="section-10" x-intersect.margin.-20%="activeSection = 'section-10'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">10</span>
                        Customer Responsibilities
                    </h2>
                    <p>When using the website or purchasing products, you agree to:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Provide truthful and accurate account, order, billing and delivery information.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Review product specifications, compatibility requirements and order details before purchasing.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Pay the amounts properly due for accepted orders.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Use products in accordance with applicable instructions, safety requirements and laws.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Keep your account credentials and payment information secure.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Treat our staff, delivery partners and other customers respectfully.</span></li>
                    </ul>
                    <p>Where a product requires professional installation, electrical work, network configuration or other specialist handling, you should use appropriately qualified personnel and follow relevant safety requirements.</p>
                </section>

                <hr class="border-line">

                {{-- 11. Promotions and Discount Codes --}}
                <section id="section-11" x-intersect.margin.-20%="activeSection = 'section-11'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">11</span>
                        Promotions and Discount Codes
                    </h2>
                    <p>We may occasionally offer promotions, discounts, vouchers or special offers. Each promotion may have its own eligibility requirements, validity period, product restrictions and redemption conditions.</p>
                    <p>Unless expressly stated otherwise, promotions cannot be exchanged for cash, transferred or combined with other offers.</p>
                    <p>Discount codes must be used in accordance with the conditions communicated with the offer. You must not sell, distribute or misuse codes in a way that is misleading, fraudulent or unauthorised.</p>
                    <p>We may correct an obvious promotional error or withdraw an offer where reasonably necessary, subject to applicable law and any orders already accepted under that offer.</p>
                </section>

                <hr class="border-line">

                {{-- 12. Prohibited Activities --}}
                <section id="section-12" x-intersect.margin.-20%="activeSection = 'section-12'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">12</span>
                        Prohibited Activities
                    </h2>
                    <p>You must not use the website to:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Commit fraud, facilitate unlawful activity or submit false orders.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Use another person's account or payment method without authorisation.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Manipulate prices, promotions, stock information or payment confirmations.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Attempt to access accounts, systems or data without permission.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Interfere with website security, availability or normal operation.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Upload malicious code or use automated tools in a way that harms the website.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Copy, scrape or commercially exploit website content without permission, except as permitted by law.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Harass, threaten, defraud or mislead other users or our staff.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Use products or services in a manner that violates applicable law.</span></li>
                    </ul>
                    <p>We may investigate suspected violations and take reasonable action, including cancelling affected orders, restricting website access or referring suspected unlawful conduct to relevant authorities where appropriate.</p>
                </section>

                <hr class="border-line">

                {{-- 13. Intellectual Property --}}
                <section id="section-13" x-intersect.margin.-20%="activeSection = 'section-13'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">13</span>
                        Intellectual Property
                    </h2>
                    <p>The website and its original content, including its design, text, graphics, logos, software and other materials, are owned by or licensed to the business operating {{ config('app.name') }} and are protected by applicable intellectual property laws.</p>
                    <p>You may browse the website and use its content for personal or internal business purchasing purposes. You may not reproduce, modify, distribute, publish or commercially exploit website content without our prior permission, except where permitted by law.</p>
                    <p>Product names, manufacturer names, logos, images and trademarks may belong to their respective owners. Their appearance on the website does not necessarily mean that those owners endorse or are affiliated with {{ config('app.name') }}.</p>
                    <p>If you believe that content on the website infringes your intellectual property rights, please contact us with sufficient information for us to review the concern.</p>
                </section>

                <hr class="border-line">

                {{-- 14. Third-Party Services --}}
                <section id="section-14" x-intersect.margin.-20%="activeSection = 'section-14'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">14</span>
                        Third-Party Services
                    </h2>
                    <p>The website may rely on or link to third-party services, including payment providers, banks, mobile money services, delivery companies, analytics providers, authentication services and manufacturers.</p>
                    <p>Third-party services may be governed by their own terms, privacy policies and operational procedures. You should review those documents where relevant.</p>
                    <p>We are not responsible for the independent acts or omissions of third-party providers, but we will take reasonable steps to assist with order or payment issues that involve services used as part of our ecommerce operations.</p>
                    <p>Links to external websites are provided for convenience and do not necessarily represent our endorsement of those websites or their content.</p>
                </section>

                <hr class="border-line">

                {{-- 15. Platform Availability --}}
                <section id="section-15" x-intersect.margin.-20%="activeSection = 'section-15'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">15</span>
                        Platform Availability
                    </h2>
                    <p>We aim to keep the website secure, accessible and functioning reliably. However, uninterrupted or error-free availability cannot be guaranteed.</p>
                    <p>The website may occasionally be unavailable because of maintenance, upgrades, technical problems, security incidents, network interruptions or circumstances beyond our reasonable control.</p>
                    <p>We may update product listings, website features, payment methods or other services from time to time. We will take reasonable steps to minimise disruption where practicable.</p>
                </section>

                <hr class="border-line">

                {{-- 16. Suspension and Termination --}}
                <section id="section-16" x-intersect.margin.-20%="activeSection = 'section-16'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">16</span>
                        Suspension and Termination
                    </h2>
                    <p>You may stop using the website or request account closure by contacting us, subject to any outstanding transactions or legal obligations.</p>
                    <p>We may restrict or suspend access to an account or website feature where reasonably necessary, including where:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>You materially breach these Terms.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Your account or an order is associated with suspected fraud or unlawful activity.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Your conduct threatens website security or other users.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>We are required to do so by law or a competent authority.</span></li>
                    </ul>
                    <p>Account closure or suspension does not remove rights or obligations arising from orders already placed, including applicable payment, delivery, warranty, refund or dispute obligations.</p>
                </section>

                <hr class="border-line">

                {{-- 17. Limitation of Liability --}}
                <section id="section-17" x-intersect.margin.-20%="activeSection = 'section-17'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">17</span>
                        Limitation of Liability
                    </h2>
                    <p>To the extent permitted by applicable law, we will not be liable for losses arising from circumstances outside our reasonable control, including third-party network interruptions, payment-provider outages or delivery-provider delays.</p>
                    <p>We are not responsible for loss arising from inaccurate information supplied by a customer, unauthorised use of an account resulting from the customer's failure to protect their credentials, or use of a product contrary to its instructions or applicable safety requirements.</p>
                    <p>Nothing in these Terms excludes or limits liability for fraud, wilful misconduct, negligence where liability cannot lawfully be excluded, or any other liability that cannot be limited under applicable law.</p>
                    <p>Nothing in this section limits statutory consumer rights or remedies relating to product quality, safety, delivery, refunds or other matters protected by law.</p>
                </section>

                <hr class="border-line">

                {{-- 18. Privacy --}}
                <section id="section-18" x-intersect.margin.-20%="activeSection = 'section-18'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">18</span>
                        Privacy and Personal Information
                    </h2>
                    <p>Your use of {{ config('app.name') }} is also governed by our <a href="{{ route('legal.privacy') }}" class="text-accent hover:text-accent-dark font-bold underline underline-offset-4">Privacy Policy</a>, which explains how we collect, use, store and share personal information.</p>
                    <p>Information may be used to manage accounts, process orders and payments, arrange delivery, respond to enquiries, provide customer support, prevent fraud and meet legal obligations.</p>
                    <p>We handle personal information in accordance with our Privacy Policy and applicable data protection laws in Kenya.</p>
                </section>

                <hr class="border-line">

                {{-- 19. Changes to Terms --}}
                <section id="section-19" x-intersect.margin.-20%="activeSection = 'section-19'" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">19</span>
                        Changes to These Terms
                    </h2>
                    <p>We may update these Terms from time to time to reflect changes in our products, services, business operations, technology or legal requirements.</p>
                    <p>Where changes are material, we will take reasonable steps to make the updated Terms available on the website or notify affected customers through appropriate communication channels.</p>
                    <p>The updated Terms will state the date on which they take effect. Your continued use of the website after that date constitutes acceptance of the updated Terms where permitted by law. Changes will not retrospectively remove rights that have already accrued.</p>
                </section>

                <hr class="border-line">

                {{-- 20. Governing Law and Contact --}}
                <section id="section-20" x-intersect.margin.-20%="activeSection = 'section-20'" class="scroll-mt-28 space-y-4">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">20</span>
                        Governing Law and Contact
                    </h2>
                    <p>These Terms are governed by the laws of Kenya.</p>
                    <p>If you have a question, concern or complaint about an order, product or these Terms, please contact us first so that we can try to resolve the matter through reasonable discussion.</p>
                    <p>Where a dispute cannot be resolved informally, it may be referred to the competent courts or other dispute-resolution mechanisms in Kenya, subject to applicable law.</p>

                    <div class="p-6 rounded-2xl bg-soft border border-line grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                        <div>
                            <p class="text-muted text-xs font-medium">Business / Website</p>
                            <p class="font-bold text-ink mt-0.5">{{ config('app.name') }}</p>
                        </div>
                        <div>
                            <p class="text-muted text-xs font-medium">Website</p>
                            <a href="{{ config('app.url') }}" class="font-bold text-accent mt-0.5 break-all hover:underline">
                                {{ config('app.url') }}
                            </a>
                        </div>
                        @if(config('mail.from.address'))
                            <div>
                                <p class="text-muted text-xs font-medium">Email</p>
                                <a href="mailto:{{ config('mail.from.address') }}" class="font-bold text-accent mt-0.5 break-all hover:underline">
                                    {{ config('mail.from.address') }}
                                </a>
                            </div>
                        @endif
                        @if(config('services.whatsapp.number'))
                            <div>
                                <p class="text-muted text-xs font-medium">WhatsApp</p>
                                <a href="https://wa.me/{{ config('services.whatsapp.number') }}" target="_blank" rel="noopener noreferrer" class="font-bold text-accent mt-0.5 hover:underline">
                                    Contact customer support
                                </a>
                            </div>
                        @endif
                    </div>
                </section>

                <div class="pt-6 border-t border-line">
                    <p class="text-xs text-muted">
                        These Terms should be read together with the {{ config('app.name') }}
                        <a href="{{ route('legal.privacy') }}" class="text-accent font-bold underline underline-offset-4">Privacy Policy</a>.
                    </p>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
