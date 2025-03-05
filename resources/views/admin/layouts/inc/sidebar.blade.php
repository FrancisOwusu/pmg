<!-- Sidemenu -->
<div class="navbar-content scroll-div ps ps--active-y">
    <ul class="nav pcoded-inner-navbar">

        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-home"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_dashboard', 1) }}</span>
            </a>
        </li>

        @canany(['application-create', 'application-view', 'student-create', 'student-view', 'student-password-print', 'student-password-change', 'student-card', 'student-transfer-in-create', 'student-transfer-in-view', 'student-transfer-out-create', 'student-transfer-out-view', 'status-type-create', 'status-type-view', 'id-card-setting-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/admission*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_admission', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @canany(['application-create', 'application-view'])
                <li class="{{ Request::is('admin/admission/application*') ? 'active' : '' }}"><a href="{{ route('admin.application.index') }}" class="">{{ trans_choice('module_application', 2) }}</a></li>
                @endcanany

                @canany(['student-create'])
                <li class="{{ Request::is('admin/admission/student/create') ? 'active' : '' }}"><a href="{{ route('admin.student.create') }}" class="">{{ trans_choice('module_registration', 1) }}</a></li>
                @endcanany

                @canany(['student-view', 'student-password-print', 'student-password-change', 'student-card'])
                <li class="{{ Request::is('admin/admission/student') ? 'active' : '' }}"><a href="{{ route('admin.student.index') }}" class="">{{ trans_choice('module_student', 1) }} {{ __('list') }}</a></li>
                @endcanany



                @canany(['status-type-create', 'status-type-view'])
                <li class="{{ Request::is('admin/admission/status-type*') ? 'active' : '' }}"><a href="{{ route('admin.status-type.index') }}" class="">{{ trans_choice('module_status_type', 2) }}</a></li>
                @endcanany

                @canany(['id-card-setting-view'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/admission/id-card-setting*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @can('id-card-setting-view')
                        <li class="{{ Request::is('admin/admission/id-card-setting*') ? 'active' : '' }}"><a href="{{ route('admin.id-card-setting.index') }}" class="">{{ trans_choice('module_id_card_setting', 1) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
            </ul>
        </li>
        @endcanany

      @canany(['student-attendance-action', 'student-attendance-report', 'student-leave-manage-view', 'student-leave-manage-edit', 'student-note-create', 'student-note-view', 'student-enroll-single', 'student-enroll-group', 'student-enroll-adddrop', 'student-enroll-complete', 'student-enroll-alumni'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/student*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-user-graduate"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_student', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">

                @canany(['student-attendance-action', 'student-attendance-report'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/student-attendance*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_student_attendance', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @can('student-attendance-action')
                        <li class="{{ Request::is('admin/student-attendance') ? 'active' : '' }}"><a href="{{ route('admin.student-attendance.index') }}" class="">{{ trans_choice('module_student_subject_attendance', 2) }}</a></li>
                        @endcan

                        @can('student-attendance-report')
                        <li class="{{ Request::is('admin/student-attendance-report*') ? 'active' : '' }}"><a href="{{ route('admin.student-attendance.report') }}" class="">{{ trans_choice('module_student_subject_report', 2) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['student-leave-manage-view', 'student-leave-manage-edit'])
                <li class="{{ Request::is('admin/student-leave-manage*') ? 'active' : '' }}"><a href="{{ route('admin.student-leave-manage.index') }}" class="">{{ trans_choice('module_leave_manage', 1) }}</a></li>
                @endcanany

                @canany(['student-note-create', 'student-note-view'])
                <li class="{{ Request::is('admin/student/student-note*') ? 'active' : '' }}"><a href="{{ route('admin.student-note.index') }}" class="">{{ trans_choice('module_student_note', 2) }}</a></li>
                @endcanany

                @canany(['student-enroll-single', 'student-enroll-group', 'student-enroll-adddrop', 'student-enroll-complete'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/student/single-enroll*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/group-enroll*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/subject-adddrop*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/course-complete*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_student_enroll', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @canany(['student-enroll-single'])
                        <li class="{{ Request::is('admin/student/single-enroll*') ? 'active' : '' }}"><a href="{{ route('admin.single-enroll.index') }}" class="">{{ trans_choice('module_single_enroll', 1) }}</a></li>
                        @endcanany

                        @canany(['student-enroll-group'])
                        <li class="{{ Request::is('admin/student/group-enroll*') ? 'active' : '' }}"><a href="{{ route('admin.group-enroll.index') }}" class="">{{ trans_choice('module_group_enroll', 2) }}</a></li>
                        @endcanany

                        @canany(['student-enroll-adddrop'])
                        <li class="{{ Request::is('admin/student/subject-adddrop*') ? 'active' : '' }}"><a href="{{ route('admin.subject-adddrop.index') }}" class="">{{ trans_choice('module_subject_adddrop', 2) }}</a></li>
                        @endcanany

                        @canany(['student-enroll-complete'])
                        <li class="{{ Request::is('admin/student/course-complete*') ? 'active' : '' }}"><a href="{{ route('admin.course-complete.index') }}" class="">{{ trans_choice('module_course_complete', 2) }}</a></li>
                        @endcanany
                    </ul>
                </li>
                @endcanany

                @canany(['student-enroll-alumni'])
                <li class="{{ Request::is('admin/student/student-alumni*') ? 'active' : '' }}"><a href="{{ route('admin.student-alumni.index') }}" class="">{{ trans_choice('module_student_alumni', 2) }}</a></li>
                @endcanany
            </ul>
        </li>
        @endcanany
        @canany(['fees-student-due', 'fees-student-quick-assign', 'fees-student-quick-received', 'fees-student-report', 'fees-student-print', 'fees-master-view', 'fees-master-create', 'fees-category-view', 'fees-category-create', 'fees-discount-view', 'fees-discount-create', 'fees-fine-view', 'fees-fine-create', 'fees-receipt-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/fees*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-money-bill-wave"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_fees_collection', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @canany(['fees-student-due', 'fees-student-quick-assign', 'fees-student-quick-received', 'fees-student-report', 'fees-student-print'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/fees-student*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_student_fees', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @can('fees-student-due')
                        <li class="{{ Request::is('admin/fees-student') ? 'active' : '' }}"><a href="{{ route('admin.fees-student.index') }}" class="">{{ trans_choice('module_fees_due', 1) }}</a></li>
                        @endcan

                        @can('fees-student-quick-assign')
                        <li class="{{ Request::is('admin/fees-student-quick-assign*') ? 'active' : '' }}"><a href="{{ route('admin.fees-student.quick.assign') }}" class="">{{ trans_choice('module_fees_quick_assign', 1) }}</a></li>
                        @endcan

                        @can('fees-student-quick-received')
                        <li class="{{ Request::is('admin/fees-student-quick-received*') ? 'active' : '' }}"><a href="{{ route('admin.fees-student.quick.received') }}" class="">{{ trans_choice('module_fees_quick_received', 1) }}</a></li>
                        @endcan

                        @canany(['fees-student-report', 'fees-student-print'])
                        <li class="{{ Request::is('admin/fees-student-report*') ? 'active' : '' }}"><a href="{{ route('admin.fees-student.report') }}" class="">{{ trans_choice('module_fees_report', 2) }}</a></li>
                        @endcanany
                    </ul>
                </li>
                @endcanany

                @canany(['fees-master-view', 'fees-master-create'])
                <li class="{{ Request::is('admin/fees-master*') ? 'active' : '' }}"><a href="{{ route('admin.fees-master.index') }}" class="">{{ trans_choice('module_fees_master', 2) }}</a></li>
                @endcanany

                @canany(['fees-category-view', 'fees-category-create'])
                <li class="{{ Request::is('admin/fees-category*') ? 'active' : '' }}"><a href="{{ route('admin.fees-category.index') }}" class="">{{ trans_choice('module_fees_category', 2) }}</a></li>
                @endcanany

                @canany(['fees-discount-view', 'fees-discount-create'])
                <li class="{{ Request::is('admin/fees-discount*') ? 'active' : '' }}"><a href="{{ route('admin.fees-discount.index') }}" class="">{{ trans_choice('module_fees_discount', 2) }}</a></li>
                @endcanany

                @canany(['fees-fine-view', 'fees-fine-create', 'fees-receipt-view'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/fees-fine*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/fees-receipt*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @canany(['fees-fine-view', 'fees-fine-create'])
                        <li class="{{ Request::is('admin/fees-fine*') ? 'active' : '' }}"><a href="{{ route('admin.fees-fine.index') }}" class="">{{ trans_choice('module_fees_fine', 2) }}</a></li>
                        @endcanany

                        @can('fees-receipt-view')
                        <li class="{{ Request::is('admin/fees-receipt*') ? 'active' : '' }}"><a href="{{ route('admin.fees-receipt.index') }}" class="">{{ trans_choice('module_fees_receipt_setting', 1) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
            </ul>
        </li>
        @endcanany

        @canany(['payment-create', 'payment-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/payments*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-money-check"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_payments', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('admin/payments') ? 'active' : '' }}"><a href="{{ route('admin.payments') }}" class="">{{ trans_choice('module_payments', 1) }}</a></li>

                </ul>
            </li>
        @endcanany

        @canany(['user-create', 'user-view', 'user-password-print', 'user-password-change', 'staff-daily-attendance-action', 'staff-daily-attendance-report', 'staff-hourly-attendance-action', 'staff-hourly-attendance-report', 'staff-note-create', 'staff-note-view', 'payroll-view', 'payroll-action', 'payroll-print', 'payroll-report', 'staff-leave-manage-edit', 'staff-leave-manage-view', 'staff-leave-create', 'staff-leave-view', 'leave-type-create', 'leave-type-view', 'work-shift-type-create', 'work-shift-type-view', 'designation-create', 'designation-view', 'department-create', 'department-view', 'tax-setting-create', 'tax-setting-view', 'pay-slip-setting-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/staff*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-users-cog"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_human_resource', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @canany(['user-create', 'user-view', 'user-password-print', 'user-password-change',])
                <li class="{{ Request::is('admin/staff/user*') ? 'active' : '' }}"><a href="{{ route('admin.user.index') }}" class="">{{ trans_choice('module_staff', 1) }} {{ __('list') }}</a></li>
                @endcanany

                @canany(['staff-daily-attendance-action', 'staff-daily-attendance-report', 'staff-hourly-attendance-action', 'staff-hourly-attendance-report'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/staff-daily-attendance*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/staff-daily-report*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/staff-hourly-attendance*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/staff-hourly-report*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_staff_attendance', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @can('staff-daily-attendance-action')
                        <li class="{{ Request::is('admin/staff-daily-attendance*') ? 'active' : '' }}"><a href="{{ route('admin.staff-daily-attendance.index') }}" class="">{{ trans_choice('module_staff_daily_attendance', 2) }}</a></li>
                        @endcan

                        @can('staff-daily-attendance-report')
                        <li class="{{ Request::is('admin/staff-daily-report*') ? 'active' : '' }}"><a href="{{ route('admin.staff-daily-attendance.report') }}" class="">{{ trans_choice('module_staff_daily_report', 2) }}</a></li>
                        @endcan

                        @can('staff-hourly-attendance-action')
                        <li class="{{ Request::is('admin/staff-hourly-attendance*') ? 'active' : '' }}"><a href="{{ route('admin.staff-hourly-attendance.index') }}" class="">{{ trans_choice('module_staff_hourly_attendance', 2) }}</a></li>
                        @endcan

                        @can('staff-hourly-attendance-report')
                        <li class="{{ Request::is('admin/staff-hourly-report*') ? 'active' : '' }}"><a href="{{ route('admin.staff-hourly-attendance.report') }}" class="">{{ trans_choice('module_staff_hourly_report', 2) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['staff-note-create', 'staff-note-view'])
                <li class="{{ Request::is('admin/staff/staff-note*') ? 'active' : '' }}"><a href="{{ route('admin.staff-note.index') }}" class="">{{ trans_choice('module_staff_note', 2) }}</a></li>
                @endcanany

                @canany(['payroll-view', 'payroll-action', 'payroll-print'])
                <li class="{{ Request::is('admin/staff/payroll') ? 'active' : '' }}"><a href="{{ route('admin.payroll.index') }}" class="">{{ trans_choice('module_payroll', 2) }}</a></li>
                @endcanany

                @canany(['payroll-report'])
                <li class="{{ Request::is('admin/staff/payroll-report*') ? 'active' : '' }}"><a href="{{ route('admin.payroll.report') }}" class="">{{ trans_choice('module_payroll_report', 2) }}</a></li>
                @endcanany

                @canany(['staff-leave-manage-edit', 'staff-leave-manage-view'])
                <li class="{{ Request::is('admin/staff/leave-manage*') ? 'active' : '' }}"><a href="{{ route('admin.leave-manage.index') }}" class="">{{ trans_choice('module_leave_manage', 2) }}</a></li>
                @endcanany

                @canany(['staff-leave-create', 'staff-leave-view'])
                <li class="{{ Request::is('admin/staff/staff-leave*') ? 'active' : '' }}"><a href="{{ route('admin.staff-leave.index') }}" class="">{{ trans_choice('module_apply_leave', 2) }}</a></li>
                @endcanany

                @canany(['leave-type-create', 'leave-type-view'])
                <li class="{{ Request::is('admin/staff/leave-type*') ? 'active' : '' }}"><a href="{{ route('admin.leave-type.index') }}" class="">{{ trans_choice('module_leave_type', 2) }}</a></li>
                @endcanany

                @canany(['work-shift-type-create', 'work-shift-type-view'])
                <li class="{{ Request::is('admin/staff/work-shift-type*') ? 'active' : '' }}"><a href="{{ route('admin.work-shift-type.index') }}" class="">{{ trans_choice('module_work_shift_type', 2) }}</a></li>
                @endcanany

                @canany(['designation-create', 'designation-view'])
                <li class="{{ Request::is('admin/staff/designation*') ? 'active' : '' }}"><a href="{{ route('admin.designation.index') }}" class="">{{ trans_choice('module_designation', 2) }}</a></li>
                @endcanany

                @canany(['department-create', 'department-view'])
                <li class="{{ Request::is('admin/staff/department*') ? 'active' : '' }}"><a href="{{ route('admin.department.index') }}" class="">{{ trans_choice('module_department', 2) }}</a></li>
                @endcanany

                @canany(['tax-setting-create', 'tax-setting-view', 'pay-slip-setting-view'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/staff/tax-setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/staff/pay-slip-setting*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @canany(['tax-setting-create', 'tax-setting-view'])
                        <li class="{{ Request::is('admin/staff/tax-setting*') ? 'active' : '' }}"><a href="{{ route('admin.tax-setting.index') }}" class="">{{ trans_choice('module_tax_setting', 2) }}</a></li>
                        @endcanany

                        @can('pay-slip-setting-view')
                        <li class="{{ Request::is('admin/staff/pay-slip-setting*') ? 'active' : '' }}"><a href="{{ route('admin.pay-slip-setting.index') }}" class="">{{ trans_choice('module_pay_slip_setting', 1) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
            </ul>
        </li>
        @endcanany

        @canany(['income-create', 'income-view', 'income-category-create', 'income-category-view', 'expense-create', 'expense-view', 'expense-category-create', 'expense-category-view', 'outcome-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/account*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-credit-card"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_income_expense', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @canany(['income-create', 'income-view'])
                <li class="{{ Request::is('admin/account/income*') ? 'active' : '' }}"><a href="{{ route('admin.income.index') }}" class="">{{ trans_choice('module_income', 1) }} {{ __('list') }}</a></li>
                @endcanany

                @canany(['income-category-create', 'income-category-view'])
                <li class="{{ Request::is('admin/account/income-category*') ? 'active' : '' }}"><a href="{{ route('admin.income-category.index') }}" class="">{{ trans_choice('module_income_category', 2) }}</a></li>
                @endcanany

                @canany(['expense-create', 'expense-view'])
                <li class="{{ Request::is('admin/account/expense*') ? 'active' : '' }}"><a href="{{ route('admin.expense.index') }}" class="">{{ trans_choice('module_expense', 1) }} {{ __('list') }}</a></li>
                @endcanany

                @canany(['expense-category-create', 'expense-category-view'])
                <li class="{{ Request::is('admin/account/expense-category*') ? 'active' : '' }}"><a href="{{ route('admin.expense-category.index') }}" class="">{{ trans_choice('module_expense_category', 2) }}</a></li>
                @endcanany

                @can('outcome-view')
                <li class="{{ Request::is('admin/account/outcome*') ? 'active' : '' }}"><a href="{{ route('admin.outcome.index') }}" class="">{{ trans_choice('module_outcome_calculation', 2) }}</a></li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['email-notify-create', 'email-notify-view', 'sms-notify-create', 'sms-notify-view', 'event-create', 'event-view', 'event-calendar', 'notice-create', 'notice-view', 'notice-category-create', 'notice-category-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/communicate*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-bullhorn"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_communicate', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @canany(['email-notify-create', 'email-notify-view'])
                <li class="{{ Request::is('admin/communicate/email-notify*') ? 'active' : '' }}"><a href="{{ route('admin.email-notify.index') }}" class="">{{ trans_choice('module_email_notify', 2) }}</a></li>
                @endcanany

                @canany(['sms-notify-create', 'sms-notify-view'])
                <li class="{{ Request::is('admin/communicate/sms-notify*') ? 'active' : '' }}"><a href="{{ route('admin.sms-notify.index') }}" class="">{{ trans_choice('module_sms_notify', 2) }}</a></li>
                @endcanany

                @canany(['event-create', 'event-view'])
                <li class="{{ Request::is('admin/communicate/event') ? 'active' : '' }}"><a href="{{ route('admin.event.index') }}" class="">{{ trans_choice('module_event', 2) }} {{ __('list') }}</a></li>
                @endcanany

                @can('event-calendar')
                <li class="{{ Request::is('admin/communicate/event-calendar') ? 'active' : '' }}"><a href="{{ route('admin.event.calendar') }}" class="">{{ trans_choice('module_calendar', 2) }}</a></li>
                @endcan

                @canany(['notice-create', 'notice-view'])
                <li class="{{ Request::is('admin/communicate/notice*') ? 'active' : '' }}"><a href="{{ route('admin.notice.index') }}" class="">{{ trans_choice('module_notice', 1) }} {{ __('list') }}</a></li>
                @endcanany

                @canany('notice-category-create', 'notice-category-view')
                <li class="{{ Request::is('admin/communicate/notice-category*') ? 'active' : '' }}"><a href="{{ route('admin.notice-category.index') }}" class="">{{ trans_choice('module_notice_category', 2) }}</a></li>
                @endcanany
            </ul>
        </li>
        @endcanany

        @canany(['topbar-setting-view', 'social-setting-view', 'slider-view', 'slider-create', 'about-us-view', 'feature-view', 'feature-create', 'course-view', 'course-create', 'web-event-view', 'web-event-create', 'news-view', 'news-create', 'gallery-view', 'gallery-create', 'faq-view', 'faq-create', 'testimonial-view', 'testimonial-create', 'page-view', 'page-create', 'call-to-action-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/web*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-globe"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_front_web', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @can('topbar-setting-view')
                <li class="{{ Request::is('admin/web/topbar-setting*') ? 'active' : '' }}"><a href="{{ route('admin.topbar-setting.index') }}" class="">{{ trans_choice('module_topbar_setting', 1) }}</a></li>
                @endcan

                @can('social-setting-view')
                <li class="{{ Request::is('admin/web/social-setting*') ? 'active' : '' }}"><a href="{{ route('admin.social-setting.index') }}" class="">{{ trans_choice('module_social_setting', 1) }}</a></li>
                @endcan

                @canany(['slider-view', 'slider-create'])
                <li class="{{ Request::is('admin/web/slider*') ? 'active' : '' }}"><a href="{{ route('admin.slider.index') }}" class="">{{ trans_choice('module_slider', 2) }}</a></li>
                @endcanany

                @can('about-us-view')
                <li class="{{ Request::is('admin/web/about-us*') ? 'active' : '' }}"><a href="{{ route('admin.about-us.index') }}" class="">{{ trans_choice('module_about_us', 1) }}</a></li>
                @endcan

                @canany(['feature-view', 'feature-create'])
                <li class="{{ Request::is('admin/web/feature*') ? 'active' : '' }}"><a href="{{ route('admin.feature.index') }}" class="">{{ trans_choice('module_feature', 2) }}</a></li>
                @endcanany

                @canany(['course-view', 'course-create'])
                <li class="{{ Request::is('admin/web/course*') ? 'active' : '' }}"><a href="{{ route('admin.course.index') }}" class="">{{ trans_choice('module_course', 2) }}</a></li>
                @endcanany

                @canany(['web-event-view', 'web-event-create'])
                <li class="{{ Request::is('admin/web/web-event*') ? 'active' : '' }}"><a href="{{ route('admin.web-event.index') }}" class="">{{ trans_choice('module_event', 2) }}</a></li>
                @endcanany

                @canany(['news-view', 'news-create'])
                <li class="{{ Request::is('admin/web/news*') ? 'active' : '' }}"><a href="{{ route('admin.news.index') }}" class="">{{ trans_choice('module_news', 2) }}</a></li>
                @endcanany

                @canany(['faq-view', 'faq-create'])
                <li class="{{ Request::is('admin/web/faq*') ? 'active' : '' }}"><a href="{{ route('admin.faq.index') }}" class="">{{ trans_choice('module_faq', 2) }}</a></li>
                @endcanany

                @canany(['gallery-view', 'gallery-create'])
                <li class="{{ Request::is('admin/web/gallery*') ? 'active' : '' }}"><a href="{{ route('admin.gallery.index') }}" class="">{{ trans_choice('module_gallery', 2) }}</a></li>
                @endcanany

                @canany(['testimonial-view', 'testimonial-create'])
                <li class="{{ Request::is('admin/web/testimonial*') ? 'active' : '' }}"><a href="{{ route('admin.testimonial.index') }}" class="">{{ trans_choice('module_testimonial', 2) }}</a></li>
                @endcanany

                @canany(['page-view', 'page-create'])
                <li class="{{ Request::is('admin/web/page*') ? 'active' : '' }}"><a href="{{ route('admin.page.index') }}" class="">{{ trans_choice('module_footer_page', 2) }}</a></li>
                @endcanany

                @can('call-to-action-view')
                <li class="{{ Request::is('admin/web/call-to-action*') ? 'active' : '' }}"><a href="{{ route('admin.call-to-action.index') }}" class="">{{ trans_choice('module_call_to_action', 1) }}</a></li>
                @endcan
            </ul>
        </li>
        @endcanany

        @canany(['setting-view', 'province-view', 'province-create', 'district-view', 'district-create', 'language-view', 'language-create', 'translations-view', 'translations-create', 'mail-setting-view', 'sms-setting-view', 'application-setting-view', 'schedule-setting-view', 'bulk-import-export-view', 'role-view', 'role-edit', 'field-staff', 'field-student', 'field-application', 'student-panel-view'])
        <li class="nav-item pcoded-hasmenu {{ Request::is('admin/setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/translations*') ? 'pcoded-trigger active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
            </a>
            <ul class="pcoded-submenu">
                @can('setting-view')
                <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" class="">{{ trans_choice('module_general_setting', 1) }}</a></li>
                @endcan

                @canany(['province-view', 'province-create'])
                <li class="{{ Request::is('admin/setting/province*') ? 'active' : '' }}"><a href="{{ route('admin.province.index') }}" class="">{{ trans_choice('module_province', 2) }}</a></li>
                @endcanany

                @canany(['district-view', 'district-create'])
                <li class="{{ Request::is('admin/setting/district*') ? 'active' : '' }}"><a href="{{ route('admin.district.index') }}" class="">{{ trans_choice('module_district', 2) }}</a></li>
                @endcanany

                @canany(['language-view', 'language-create'])
                <li class="{{ Request::is('admin/setting/language*') ? 'active' : '' }}"><a href="{{ route('admin.language.index') }}" class="">{{ trans_choice('module_language', 2) }}</a></li>
                @endcanany

                @canany(['translations-view', 'translations-create'])
                <li class="{{ Request::is('admin/translations*') ? 'active' : '' }}"><a href="{{ route('admin.translations.index') }}" class="">{{ trans_choice('module_translate', 2) }}</a></li>
                @endcanany

                @can('mail-setting-view')
                <li class="{{ Request::is('admin/setting/mail-setting*') ? 'active' : '' }}"><a href="{{ route('admin.mail-setting.index') }}" class="">{{ trans_choice('module_mail_setting', 1) }}</a></li>
                @endcan

                @can('sms-setting-view')
                <li class="{{ Request::is('admin/setting/sms-setting*') ? 'active' : '' }}"><a href="{{ route('admin.sms-setting.index') }}" class="">{{ trans_choice('module_sms_setting', 1) }}</a></li>
                @endcan

                @can('application-setting-view')
                <li class="{{ Request::is('admin/setting/application-setting*') ? 'active' : '' }}"><a href="{{ route('admin.application-setting.index') }}" class="">{{ trans_choice('module_application_setting', 1) }}</a></li>
                @endcan


                @canany(['role-view', 'role-edit'])
                <li class="{{ Request::is('admin/setting/role*') ? 'active' : '' }}"><a href="{{ route('admin.role.index') }}" class="">{{ trans_choice('module_role', 2) }}</a></li>
                @endcanany

                @canany(['field-staff', 'field-student', 'field-application'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/setting/field*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-mtext">{{ trans_choice('module_field_setting', 2) }}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @canany(['field-staff'])
                        <li class="{{ Request::is('admin/setting/field-user*') ? 'active' : '' }}"><a href="{{ route('admin.field.user') }}" class="">{{ trans_choice('module_staff', 2) }}</a></li>
                        @endcan

                        @canany(['field-student'])
                        <li class="{{ Request::is('admin/setting/field-student*') ? 'active' : '' }}"><a href="{{ route('admin.field.student') }}" class="">{{ trans_choice('module_student', 2) }}</a></li>
                        @endcan

                        @canany(['field-application'])
                        <li class="{{ Request::is('admin/setting/field-application*') ? 'active' : '' }}"><a href="{{ route('admin.field.application') }}" class="">{{ trans_choice('module_application', 2) }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['student-panel-view'])
                <li class="{{ Request::is('admin/setting/student-panel*') ? 'active' : '' }}"><a href="{{ route('admin.student.panel') }}" class="">{{ trans_choice('module_student_panel', 2) }}</a></li>
                @endcanany
            </ul>
        </li>
        @endcanany

        @canany(['profile-view', 'profile-edit'])
        <li class="nav-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
            <a href="{{ route('admin.profile.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-user-edit"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_profile', 2) }}</span>
            </a>
        </li>
        @endcanany

    </ul>
</div>
<!-- End Sidebar -->
