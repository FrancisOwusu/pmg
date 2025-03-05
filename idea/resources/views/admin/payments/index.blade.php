@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>

                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card">
                        @if(isset($rows))
                            <div class="card-block">
                                <!-- [ Data table ] start -->
                                <div class="table-responsive">
                                    <table id="export-table" class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('field_student_id') }}</th>
                                            <th>{{ __('field_fees_type') }}</th>
                                            <th>Transaction ID</th>
                                            <th>Amount Paid</th>

                                            <th>{{ __('field_name') }}</th>
                                            <th>{{ __('field_status') }}</th>
                                            <th>{{ __('field_date') }}</th>
                                            {{--                                            <th>{{ __('field_action') }}</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $rows as $key => $row )
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @isset($row->fee->studentEnroll->student->student_id)
                                                        <a href="{{ route('admin.student.show', $row->fee->studentEnroll->student->id) }}">
                                                            #{{ $row->fee->studentEnroll->student->student_id ?? '' }}
                                                        </a>
                                                    @endisset
                                                </td>
                                                <td>{{ $row->fee->category->title ?? '' }}</td>
                                                <td>{{$row->transaction_ref_no}}</td>
                                                <td>
                                                    @if(isset($setting->decimal_place))
                                                        {{ number_format((float)$row->amount, $setting->decimal_place, '.', '') }}
                                                    @else
                                                        {{ number_format((float)$row->amount, 2, '.', '') }}
                                                    @endif
                                                    {!! $setting->currency_symbol !!}
                                                </td>

                                                <td>
                                                    @isset($row->fee->studentEnroll->student->student_id)
                                                        {{$row->fee->studentEnroll->student->first_name}}  {{$row->fee->studentEnroll->student->last_name}}

                                                    @endisset
                                                </td>


                                                <td>
                                                    {{$row->transaction_status}}
                                                </td>
                                                <td>
                                                    @if(isset($setting->date_format))
                                                        {{ date($setting->date_format, strtotime($row->created_at)) }}
                                                    @else
                                                        {{ date("Y-m-d H:i:s", strtotime($row->created_at)) }}
                                                    @endif
                                                </td>

                                                {{--                                                <td>--}}
                                                {{--                                                    @can($access.'-print')--}}
                                                {{--                                                        @if(isset($print))--}}
                                                {{--                                                            <a href="{{ route($route.'.print', ['id' => $row->id]) }}" target="_blank" class="btn btn-icon btn-dark btn-sm">--}}
                                                {{--                                                                <i class="fas fa-print"></i>--}}
                                                {{--                                                            </a>--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                    @endcan--}}
                                                {{--                                                </td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- [ Data table ] end -->
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    @isset($print)
        @if (\Session::has('receipt'))
            <script type="text/javascript">
                PopupWin('{{ route($route.'.print', ['id' => \Session::get('receipt')]) }}', '{{ $title }}', 1000, 600);
            </script>
        @endif
    @endisset
@endsection
