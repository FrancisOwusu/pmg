@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('modal_edit') }} {{ $title }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-block">
                      <div class="row">
                        <!-- Form Start -->
                        <div class="form-group col-md-4">
                            <label for="title">{{ __('field_title') }} <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $row->title }}" required>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_title') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="faculty">{{ __('field_faculty') }}</label>
                            <input type="text" class="form-control" name="faculty" id="faculty" value="{{ $row->faculty }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_faculty') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="semesters">{{ __('field_total') }} {{ __('field_semester') }}</label>
                            <input type="text" class="form-control" name="semesters" id="semesters" value="{{ $row->semesters }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_total') }} {{ __('field_semester') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="credits">{{ __('field_total_credit_hour') }}</label>
                            <input type="text" class="form-control" name="credits" id="credits" value="{{ $row->credits }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_total_credit_hour') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="courses">{{ __('field_total') }} {{ __('field_subject') }}</label>
                            <input type="text" class="form-control" name="courses" id="courses" value="{{ $row->courses }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_total') }} {{ __('field_subject') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="duration">{{ __('field_duration') }}</label>
                            <input type="text" class="form-control" name="duration" id="duration" value="{{ $row->duration }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_duration') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="fee">{{ __('field_total') }} {{ __('field_fee') }} / {{__('per_semester')}} ({!! $setting->currency_symbol !!})</label>

                            <input type="text" class="form-control autonumber" name="fee" id="fee" value="{{ round($row->fee) }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_total') }} {{ __('field_fee') }}
                            </div>
                        </div>
                          <div class="form-group col-md-4">
                              <label for="hostel_fee">{{__('hostel_fee')}} ({!! $setting->currency_symbol !!})</label>
                              <input type="text" class="form-control autonumber" name="hostel_fee" id="hostel_fee"
                                     value="{{round($row->hostel_fee)}}">

                              <div class="invalid-feedback">
                                  {{ __('required_field') }}  {{ __('field_hostel_fee') }}
                              </div>
                          </div>
                        <div class="form-group col-md-4">
                            <label for="attach">{{ __('field_thumbnail') }}: <span>{{ __('image_size', ['height' => 500, 'width' => 800]) }}</span></label>
                            <input type="file" class="form-control" name="attach" id="attach" value="{{ old('attach') }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_thumbnail') }}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">{{ __('field_description') }} <span>*</span></label>
                            <textarea class="form-control texteditor" name="description" id="description" required>{{ $row->description }}</textarea>

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ __('field_description') }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status" class="form-label">{{ __('select_status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" @if( $row->status == 1 ) selected @endif>{{ __('status_active') }}</option>
                                <option value="0" @if( $row->status == 0 ) selected @endif>{{ __('status_inactive') }}</option>
                            </select>
                        </div>
                        <!-- Form End -->
                      </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- [ Card ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection
