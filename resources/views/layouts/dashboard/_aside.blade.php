<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> متصل</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i><span>@lang('site.home')</span></a></li>

            @if (auth()->user()->hasPermission('users_read'))
                <li><a href="{{ route('users.index') }}"><i class="fa fa-envelope-o"></i><span>المستخدمين</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('states_read'))
                <li><a href="{{ route('states.index') }}"><i class="fa fa-envelope-o"></i><span>الولايات</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('local_read'))
                <li><a href="{{ route('local.index') }}"><i class="fa fa-building"></i><span>المحليات</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('administrative_unit_read'))
                <li><a href="{{ route('adminUnit.index') }}"><i class="fa fa-cogs"></i><span>الوحدات
                            الإداريه</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('work_read'))
                <li><a href="{{ route('work.index') }}"><i class="fa fa-group"></i><span>العمل</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('cause_lawsuit_read'))
                <li><a href="{{ route('causeLawsuit.index') }}"><i class="fa fa-building"></i><span>سبب
                            الدعوى</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('prose_text_read'))
                <li><a href="{{ route('proseText.index') }}"><i class="fa fa-envelope-o"></i><span>مواضيع
                            الدعوى</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('contract_subject_read'))
                <li><a href="{{ route('contractSubject.index') }}"><i class="fa fa-th"></i><span>موضوع
                            العقد</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('consult_subject_read'))
                <li><a href="{{ route('consultSubject.index') }}"><i class="fa fa-th"></i><span>موضوع
                            الإستشاره</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('lawyers_read'))
                <li><a href="{{ route('lawyers.index') }}"><i class="fa fa-cogs"></i><span>المحامين</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('claimants_read'))
                <li><a href="{{ route('claimants.index') }}"><i class="fa fa-cogs"></i><span>عمل
                            المدعين</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('courts_read'))
                <li><a href="{{ route('courts.index') }}"><i class="fa fa-cogs"></i><span>المحاكم</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('clients_read'))
                <li><a href="{{ route('clients.index') }}"><i class="fa fa-cogs"></i><span>الموكل</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('clientsTo_read'))
                <li><a href="{{ route('clientsTo.index') }}"><i class="fa fa-cogs"></i><span>الموكل له</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('witness_read'))
                <li><a href="{{ route('witness.index') }}"><i class="fa fa-cogs"></i><span>الشهود</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('customers_read'))
                <li><a href="{{ route('customers.index') }}"><i class="fa fa-cogs"></i><span>المدعي</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('customerTo_read'))
                <li><a href="{{ route('customersTo.index') }}"><i class="fa fa-cogs"></i><span>المدعي
                            عليه</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('judges_read'))
                <li><a href="{{ route('judges.index') }}"><i class="fa fa-cogs"></i><span>القضاء</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('prosecution_read'))
                <li><a href="{{ route('prosecution.index') }}"><i class="fa fa-cogs"></i><span>الدعاوي</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('sessions_read'))
                <li><a href="{{ route('sessions.index') }}"><i class="fa fa-cogs"></i><span>الجلسات</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('session_witness_read'))
                <li><a href="{{ route('sessionWitness.index') }}"><i class="fa fa-cogs"></i><span>شهود
                            الجلسات</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('appeal_read'))
                <li><a href="{{ route('appeal.index') }}"><i class="fa fa-cogs"></i><span>الإستئنافات</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('consults_read'))
                <li><a href="{{ route('consults.index') }}"><i class="fa fa-cogs"></i><span>الإستشارات</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('contract_read'))
                <li><a href="{{ route('contract.index') }}"><i class="fa fa-cogs"></i><span>العقود</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('authorization_read'))
                <li><a href="{{ route('authorization.index') }}"><i
                            class="fa fa-th"></i><span>التوكيلات</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('address_read'))
                <li><a href="{{ route('address.index') }}"><i class="fa fa-th"></i><span>العناوين</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('messages_read'))
                <li><a href="{{ route('messages.index') }}"><i class="fa fa-th"></i><span>الرسائل</span></a>
                </li>
            @endif

            @if (auth()->user()->hasPermission('subject_authorization_read'))
                <li><a href="{{ route('subjectAuthorization.index') }}"><i class="fa fa-th"></i><span>موضوع
                            التوكيل</span></a></li>
            @endif

        </ul>

    </section>

</aside>
