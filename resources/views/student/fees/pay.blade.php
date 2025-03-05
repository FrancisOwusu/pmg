<!-- Edit modal content -->
<div id="payModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" id="payModal-{{ $row->id }}" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
{{--            <form  id="payment-form" class="needs-validation" action="{{route('student_fees.pay')}}" data-action="{{route('student_fees.pay')}}" novalidate>--}}

                <form id="payment-form"  class="needs-validation" novalidate action="{{ route('student_fees.pay')}}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- View Start -->
                    
                    <div class="">
                        <div class="row">
                            <div class="col-md-6">
                                <p><mark class="text-primary">{{ __('field_student_id') }}:</mark> #{{ $row->studentEnroll->student->student_id ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('field_name') }}:</mark> {{ $row->studentEnroll->student->first_name ?? '' }} {{ $row->studentEnroll->student->last_name ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{ __('field_program') }}:</mark> {{ $row->studentEnroll->program->title ?? '' }}</p><hr/>
                                <p><mark class="text-primary">{{__('amount_due')}}:</mark>  @if(isset($setting->decimal_place))
                                        {{ number_format((float)$row->fee_balance, $setting->decimal_place, '.', '') }}
                                    @else
                                        {{ number_format((float)$row->fee_balance, 2, '.', '') }}
                                    @endif </p><hr/>
                            </div>

                      
                            <div class="form-group col-md-6">
                                <label for="fee_amount" class="form-label">{{ __('field_amount') }} ({!! $setting->currency_symbol !!}) <span>*</span></label>
{{--                                <input type="text" class="form-control autonumber" name="fee_amount" id="fee_amount" value="" required >--}}
                                <input type="text" class="form-control autonumber" name="amount_paid" id="fee_amount" value="" required >
{{--                                <input type="text" class="form-control autonumber" name="fee_amount" id="fee_amount" value="{{ round($row->fee_amount, 2) }}" required >--}}

                                <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_amount') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="fee_id" value="{{ $row->id }}" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
                    <button type="submit"  id="btn-pay-{{$row->id}}" class="btn btn-success btn-pay-b"><i class="fas fa-money-check"></i> {{__('proceed')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
