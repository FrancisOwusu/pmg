<!-- Show modal content -->
<div id="showModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ __('modal_view') }} {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Details View Start -->
                <h4><mark class="text-primary">{{ __('field_title') }}:</mark> {{ $row->title }}</h4>
                <hr/>
                <div class="">
                    <div class="row">
                        <div class="col-md-6">
                            <p><mark class="text-primary">{{ __('field_faculty') }}:</mark> {{ $row->faculty }}</p><hr/>
                            <p><mark class="text-primary">{{ __('field_total') }} {{ __('field_semester') }}:</mark> {{ $row->semesters }}</p><hr/>
                            <p><mark class="text-primary">{{ __('field_total_credit_hour') }}:</mark> {{ $row->credits }}</p><hr/>
                        </div>
                        <div class="col-md-6">
                            <p><mark class="text-primary">{{ __('field_total') }} {{ __('field_subject') }}:</mark> {{ $row->courses }}</p><hr/>
                            <p><mark class="text-primary">{{ __('field_duration') }}:</mark> {{ $row->duration }}</p><hr/>
                            <p><mark class="text-primary">{{ __('field_total') }} {{ __('field_fee') }} / {{__('per_semester')}}:</mark>{!! $setting->currency_symbol !!} {{ round($row->fee, $setting->decimal_place ?? 2) }} </p><hr/>
                            <p><mark class="text-primary">{{ __('field_hostel_fee') }} {{ __('field_fee') }} / {{__('per_semester')}}:</mark>{!! $setting->currency_symbol !!} {{ round($row->hostel_fee, $setting->decimal_place ?? 2) }} </p><hr/>

                            <p><mark class="text-primary">{{ __('field_status') }}:</mark>
                                @if( $row->status == 1 )
                                <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                @else
                                <span class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p><mark class="text-primary">{{ __('field_description') }}:</mark> {!! $row->description !!}</p><hr/>
                        </div>
                    </div>
                </div>
                <!-- Details View End -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
            </div>
        </div>
    </div>
</div>
