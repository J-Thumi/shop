@extends('layouts.app', ['title' => 'Privacy Policy — ' . config('app.name')])

@section('content')
<div x-data="{ activeSection: 'privacy-1' }" class="bg-paper min-h-screen">

    <!-- Header Banner -->
    <div class="border-b border-line bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-soft border border-line text-xs font-bold text-ink mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                    Data Protection & Privacy
                </div>
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl md:text-5xl tracking-tight text-ink mb-4">
                    Privacy Policy
                </h1>
                <p class="text-sm sm:text-base text-muted leading-relaxed mb-6">
                    How {{ config('app.name') }} collects, uses, stores, shares and protects your personal information when you browse our store, create an account, place an order or contact us.
                </p>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-medium text-muted pt-4 border-t border-line">
                    <div>
                        <span class="text-ink font-bold">Effective Date:</span> {{ config('legal.effective_date', now()->format('F j, Y')) }}
                    </div>
                    <span class="hidden sm:inline text-line">•</span>
                    <div>
                        <span class="text-ink font-bold">Last Updated:</span> {{ config('legal.updated_date', now()->format('F j, Y')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Layout: Sticky TOC + Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- Left Sidebar: Table of Contents -->
            <aside class="hidden lg:block lg:col-span-4 sticky top-28">
                <div class="bg-white border border-line rounded-2xl p-6 shadow-sm">
                    <h2 class="font-display font-bold text-xs uppercase tracking-wider text-muted mb-4">
                        Table of Contents
                    </h2>
                    <nav class="space-y-1 max-h-[calc(100vh-14rem)] overflow-y-auto pr-2 text-xs">
                        @php
                            $sections = [
                                '1. Introduction',
                                '2. Who Is Responsible for Your Personal Data?',
                                '3. Personal Information We Collect',
                                '4. How We Use Your Information',
                                '5. How We Share Your Information',
                                '6. Cookies & Similar Technologies',
                                '7. Data Storage & Security',
                                '8. Data Retention',
                                '9. International Data Transfers',
                                '10. Your Data Protection Rights',
                                '11. Third-Party Websites & Services',
                                '12. Children’s Privacy',
                                '13. Changes to This Policy',
                                '14. Contact & Privacy Requests',
                            ];
                        @endphp

                        @foreach($sections as $index => $label)
                            @php $id = 'privacy-' . ($index + 1); @endphp
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
                        <a href="{{ route('legal.terms') }}" class="inline-flex items-center justify-between w-full px-3.5 py-2.5 text-xs font-bold text-ink bg-soft hover:bg-line rounded-xl transition">
                            <span>Terms of Service</span>
                            <svg class="w-4 h-4 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Document Body -->
            <div class="lg:col-span-8 bg-white border border-line rounded-2xl p-6 sm:p-10 shadow-sm space-y-10 text-sm sm:text-[15px] text-[#3a3a40] leading-relaxed">

                <!-- 1. Introduction -->
                <section id="privacy-1" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">01</span>
                        Introduction
                    </h2>
                    <p>{{ config('app.name') }} respects your privacy and is committed to handling your personal information responsibly.</p>
                    <p>This Privacy Policy explains how {{ config('app.name') }} collects, uses, stores, shares and protects personal information when you visit our website, browse products, create an account, place or receive an order, make a payment, contact customer support or otherwise use our services.</p>
                    <p>In this policy, "{{ config('app.name') }}", "we", "our" and "us" refer to the business operating this website under the name configured for this application.</p>
                    <p class="p-4 rounded-xl bg-soft border border-line text-ink font-medium text-xs sm:text-sm">
                        This policy is intended to explain our personal data practices in the context of applicable data protection laws, including Kenya’s Data Protection Act, 2019 and relevant regulations.
                    </p>
                </section>

                <hr class="border-line">

                <!-- 2. Data Controller -->
                <section id="privacy-2" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">02</span>
                        Who Is Responsible for Your Personal Data?
                    </h2>
                    <p>{{ config('app.name') }} determines the purposes and means of processing personal information collected through this online store and acts as a data controller for those activities.</p>
                    <p>These activities may include:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Creating and managing customer accounts.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Processing orders, payments, deliveries and returns.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Responding to enquiries, complaints and support requests.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Maintaining store security and preventing fraud.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Meeting applicable legal, tax and accounting obligations.</span></li>
                    </ul>
                    <p>Some service providers, such as payment processors and delivery companies, may independently determine how they process certain information. Their own privacy notices may also apply to those activities.</p>
                </section>

                <hr class="border-line">

                <!-- 3. Personal Information Collected -->
                <section id="privacy-3" class="scroll-mt-28 space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                            <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">03</span>
                            Personal Information We Collect
                        </h2>
                        <p>The information we collect depends on how you interact with {{ config('app.name') }}. It may include the following categories:</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.1 Account Information</h3>
                            <p class="text-xs text-muted">When you create or manage an account, we may collect:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Full name.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Email address.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Phone number.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Password credentials, stored in protected form.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Account preferences and identifiers.</span></li>
                            </ul>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.2 Order Information</h3>
                            <p class="text-xs text-muted">When you place an order, we may collect:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Products ordered, quantities and product options.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Order number, date, value and status.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Billing and delivery details.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Delivery instructions and order history.</span></li>
                            </ul>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.3 Payment Information</h3>
                            <p class="text-xs text-muted">To initiate, verify and reconcile payments, we may receive:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Transaction references and payment status.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Amount paid, currency and transaction timestamps.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Payment method and provider response information.</span></li>
                            </ul>
                            <p class="text-xs text-muted pt-1">Payment credentials, such as card details or mobile money authentication data, may be handled directly by the relevant payment provider. We do not intentionally store full payment credentials unless expressly stated at the point of collection.</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.4 Delivery Information</h3>
                            <p class="text-xs text-muted">To fulfil an order, we may collect:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Recipient name and phone number.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Delivery address, town, area or collection point.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Delivery instructions and fulfilment updates.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Delivery confirmation or proof of fulfilment.</span></li>
                            </ul>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.5 Customer Support Information</h3>
                            <p class="text-xs text-muted">When you contact us, we may collect:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Your messages, questions and feedback.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Product, order or warranty details relevant to your enquiry.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Information you choose to provide in attachments or images.</span></li>
                            </ul>
                        </div>

                        <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                            <h3 class="font-display font-bold text-sm text-ink">3.6 Marketing Preferences</h3>
                            <p class="text-xs text-muted">Where you choose to receive marketing, we may collect:</p>
                            <ul class="space-y-1.5 text-xs">
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Your communication preferences.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Subscription and opt-out records.</span></li>
                                <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-1.5 shrink-0"></span><span>Responses to promotions or surveys, where applicable.</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="p-5 rounded-2xl bg-paper border border-line space-y-2">
                        <h3 class="font-display font-bold text-sm text-ink">3.7 Technical and Usage Information</h3>
                        <p class="text-xs text-muted">When you access our website, certain information may be collected automatically, such as:</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs pt-1">
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>IP address and approximate location derived from it</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Browser and device information</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Operating system</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Access timestamps</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Pages, products and features viewed</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Error, diagnostic and security logs</span></div>
                            <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span><span>Session and cookie identifiers</span></div>
                        </div>
                    </div>
                </section>

                <hr class="border-line">

                <!-- 4. Use of Information -->
                <section id="privacy-4" class="scroll-mt-28 space-y-4">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">04</span>
                        How We Use Your Information
                    </h2>
                    <p>We use personal information for specific and legitimate purposes, which may include:</p>
                    <div class="space-y-3">
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Account Management</h3>
                            <p class="text-xs text-muted mt-0.5">To register and authenticate customers, maintain account details and provide account-related features.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Order Processing and Fulfilment</h3>
                            <p class="text-xs text-muted mt-0.5">To receive and process orders, confirm product selections, arrange delivery or collection and provide order updates.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Payments and Reconciliation</h3>
                            <p class="text-xs text-muted mt-0.5">To initiate and verify payments, reconcile transactions, issue receipts and investigate failed, reversed or disputed payments.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Customer Service and After-Sales Support</h3>
                            <p class="text-xs text-muted mt-0.5">To respond to enquiries, handle complaints, administer eligible returns and refunds, and assist with product support or warranty matters.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Personalisation and Store Improvement</h3>
                            <p class="text-xs text-muted mt-0.5">To remember preferences, understand how customers use the store, improve product information and make our website easier to use.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Security and Fraud Prevention</h3>
                            <p class="text-xs text-muted mt-0.5">To verify activity, protect accounts and transactions, detect suspicious behaviour and maintain the security of our systems.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Legal and Regulatory Compliance</h3>
                            <p class="text-xs text-muted mt-0.5">To maintain appropriate business records and comply with applicable tax, accounting, consumer protection and other legal obligations.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Service Communications</h3>
                            <p class="text-xs text-muted mt-0.5">To send important transactional messages, including account verification, order confirmations, payment notifications, delivery updates and responses to support requests.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-soft/60 border border-line">
                            <h3 class="font-bold text-ink text-sm">Marketing Communications</h3>
                            <p class="text-xs text-muted mt-0.5">Where permitted by law and where we have obtained any required consent or established another lawful basis, we may send information about products, offers and promotions. You can opt out of marketing messages at any time. This will not stop essential service communications.</p>
                        </div>
                    </div>
                </section>

                <hr class="border-line">

                <!-- 5. Sharing Information -->
                <section id="privacy-5" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">05</span>
                        How We Share Your Information
                    </h2>
                    <p class="font-bold text-ink">We do not sell your personal information.</p>
                    <p>We may share information that is relevant and necessary with the following categories of recipients:</p>
                    <ul class="space-y-3 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Payment Providers:</strong> We share transaction details needed to process, verify, secure and reconcile payments. The provider’s own privacy notice may apply to information it collects directly.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Delivery and Logistics Providers:</strong> We may provide recipient names, phone numbers, delivery addresses and order details so that products can be delivered or made available for collection.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Communication Providers:</strong> We may use email, SMS or messaging providers to send verification codes, receipts, order updates and customer support communications.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Hosting and Technology Providers:</strong> We may use hosting, infrastructure, database, analytics, security and monitoring providers to operate and protect the website.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Professional Advisers:</strong> Where necessary, relevant information may be shared with legal, accounting, audit or other professional advisers who assist us in operating the business.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span><strong class="text-ink">Authorities and Legal Recipients:</strong> We may disclose information where required by law, a court order or a lawful regulatory request, or where necessary to establish, exercise or defend legal claims.</span></li>
                    </ul>
                    <p>Where a third party processes personal information on our behalf, we take reasonable steps to require appropriate confidentiality, security and data protection safeguards.</p>
                </section>

                <hr class="border-line">

                <!-- 6. Cookies -->
                <section id="privacy-6" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">06</span>
                        Cookies and Similar Technologies
                    </h2>
                    <p>{{ config('app.name') }} may use cookies and similar technologies to:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Keep you signed in and maintain secure sessions.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Remember items in your shopping cart and relevant preferences.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Support checkout and other essential store functions.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Protect the website against security threats and misuse.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Understand website performance and improve the shopping experience.</span></li>
                    </ul>
                    <p>Some cookies are necessary for the website, account, cart and checkout to function. Other cookies, such as optional analytics or advertising cookies, should only be used in accordance with applicable consent requirements.</p>
                    <p>You can manage or disable cookies through your browser settings. Disabling essential cookies may affect cart, login or checkout functionality.</p>
                </section>

                <hr class="border-line">

                <!-- 7. Security -->
                <section id="privacy-7" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">07</span>
                        Data Storage and Security
                    </h2>
                    <p>We take reasonable technical and organisational measures designed to protect personal information against unauthorised access, alteration, disclosure, loss or destruction.</p>
                    <p>Depending on the systems and services in use, these measures may include:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Password hashing and secure authentication practices.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Access controls and role-based permissions.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>HTTPS and other appropriate communication safeguards.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Database, hosting and infrastructure security measures.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Monitoring, logging, maintenance and security updates.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Restricted access to personal and transaction information.</span></li>
                    </ul>
                    <p>No website or internet-based service can guarantee absolute security. We therefore cannot promise that information will be immune from every possible security incident. If a personal data breach occurs, we will take the steps required by applicable law.</p>
                </section>

                <hr class="border-line">

                <!-- 8. Retention -->
                <section id="privacy-8" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">08</span>
                        Data Retention
                    </h2>
                    <p>We retain personal information only for as long as reasonably necessary to fulfil the purposes for which it was collected, including service delivery, dispute resolution, security and compliance with legal obligations.</p>
                    <p>Retention periods may depend on:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Whether your customer account remains active.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Whether an order, return, refund, warranty matter or complaint remains unresolved.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Payment reconciliation, tax and accounting requirements.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Fraud prevention, security and legal claims.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Applicable legal and regulatory retention obligations.</span></li>
                    </ul>
                    <p>When personal information is no longer required, we will take reasonable steps to delete it, anonymise it or otherwise securely dispose of it, subject to applicable law.</p>
                    <p>Closing an account does not necessarily result in immediate deletion of order, payment or accounting records that we are legally required or otherwise lawfully permitted to retain.</p>
                </section>

                <hr class="border-line">

                <!-- 9. International Transfers -->
                <section id="privacy-9" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">09</span>
                        International Data Transfers
                    </h2>
                    <p>Some technology, hosting, payment, analytics or communication providers may store or process information outside Kenya.</p>
                    <p>Where personal information is transferred outside Kenya, we will take steps to ensure that the transfer is supported by an applicable lawful basis and appropriate safeguards as required by Kenyan data protection law.</p>
                </section>

                <hr class="border-line">

                <!-- 10. Rights -->
                <section id="privacy-10" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">10</span>
                        Your Data Protection Rights
                    </h2>
                    <p>Subject to applicable law, you may have the right to:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Be informed about how your personal information is used.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Request access to personal information we hold about you.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Request correction of inaccurate, incomplete or misleading information.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Request deletion of personal information where legally permitted.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Object to or request restriction of certain processing activities, where applicable.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Withdraw consent where processing is based on your consent.</span></li>
                        <li class="flex items-start gap-2.5"><span class="w-1.5 h-1.5 rounded-full bg-accent mt-2 shrink-0"></span><span>Exercise other rights available under applicable data protection laws.</span></li>
                    </ul>
                    <p>To exercise these rights, contact us using the details in <a href="#privacy-14" class="text-accent font-bold hover:underline">Section 14</a>. We may need to verify your identity before responding. Some information may need to be retained where required by law or where another lawful basis applies.</p>
                </section>

                <hr class="border-line">

                <!-- 11. Third Parties -->
                <section id="privacy-11" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">11</span>
                        Third-Party Websites and Services
                    </h2>
                    <p>{{ config('app.name') }} may contain links to external websites or integrate with third-party services, including payment, delivery, authentication, analytics or communication services.</p>
                    <p>We do not control the privacy practices of independent third parties. You should review their privacy policies and terms before providing personal information directly to them.</p>
                    <p>Your use of a third-party service may also be subject to that provider’s own terms, privacy notices and security practices.</p>
                </section>

                <hr class="border-line">

                <!-- 12. Children's Privacy -->
                <section id="privacy-12" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">12</span>
                        Children’s Privacy
                    </h2>
                    <p>Our online store is not intended to encourage children to provide personal information without the involvement or authorisation of a parent or guardian where required by law.</p>
                    <p>Where a product or service is intended for children, or where we become aware that we have collected a child’s personal information, we will handle that information in accordance with applicable legal requirements and take appropriate steps where necessary.</p>
                    <p>If you believe a child has provided personal information to us in circumstances that require parental or guardian involvement, please contact us using the details in Section 14.</p>
                </section>

                <hr class="border-line">

                <!-- 13. Policy Changes -->
                <section id="privacy-13" class="scroll-mt-28 space-y-3">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">13</span>
                        Changes to This Privacy Policy
                    </h2>
                    <p>We may update this Privacy Policy to reflect changes in our store, services, technology, data practices or legal obligations.</p>
                    <p>Where appropriate, we will notify customers of material changes through the website, their account or another suitable communication channel.</p>
                    <p>The latest version will be published on this page with its effective date and last updated date.</p>
                </section>

                <hr class="border-line">

                <!-- 14. Contact -->
                <section id="privacy-14" class="scroll-mt-28 space-y-4">
                    <h2 class="font-display font-bold text-xl text-ink flex items-center gap-2.5">
                        <span class="text-xs font-extrabold px-2 py-0.5 rounded-md bg-accent/10 text-accent">14</span>
                        Contact Us and Privacy Requests
                    </h2>
                    <p>For questions, complaints or requests relating to this Privacy Policy or your personal information, contact us using the details below:</p>

                    <div class="p-6 rounded-2xl bg-soft border border-line grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                        <div>
                            <p class="text-muted text-xs font-medium">Business / Store</p>
                            <p class="font-bold text-ink mt-0.5">{{ config('app.name') }}</p>
                        </div>
                        <div>
                            <p class="text-muted text-xs font-medium">Website</p>
                            <a href="{{ config('app.url') }}" class="font-bold text-accent mt-0.5 hover:underline">{{ config('app.url') }}</a>
                        </div>
                        <div>
                            <p class="text-muted text-xs font-medium">Privacy Email</p>
                            <a href="mailto:{{ config('mail.from.address') }}" class="font-bold text-accent mt-0.5 hover:underline">{{ config('mail.from.address') }}</a>
                        </div>
                        <div>
                            <p class="text-muted text-xs font-medium">Customer Support</p>
                            <a href="mailto:{{ config('mail.from.address') }}" class="font-bold text-accent mt-0.5 hover:underline">{{ config('mail.from.address') }}</a>
                        </div>
                    </div>

                    <div class="p-5 rounded-2xl bg-dark text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <p class="text-xs font-bold uppercase tracking-wider text-accent">Regulatory Oversight</p>
                            <p class="text-xs sm:text-sm text-[#c9c9cc]">
                                If you have concerns about how your personal information is handled, you may also contact the Office of the Data Protection Commissioner in Kenya.
                            </p>
                        </div>
                        <a href="https://www.odpc.go.ke/" target="_blank" rel="noopener noreferrer" class="shrink-0 inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold text-white bg-accent hover:bg-accent-dark rounded-xl transition">
                            Visit ODPC Website ↗
                        </a>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
@endsection
