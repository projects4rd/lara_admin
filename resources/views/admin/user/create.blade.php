@extends('layouts.admin')

@section('title', 'Create')

@section('content')


<div id="flash-msg">
    @include('shared.flash-message')
</div>

<div class="rd-portlet">
    <div class="rd-subheader" id="rd_subheader">

        <div class="rd-subheader__main">

            <h3 class="rd-subheader__title">
                New User
            </h3>

            <span class="rd-subheader__separator rd-subheader__separator--v"></span>

            <div class="rd-subheader__group" id="rd_subheader_search">
                <span class="rd-subheader__desc" id="rd_subheader_total">
                    Enter user details and save </span>
            </div>

        </div>

        <div class="rd-subheader__toolbar text-right">

            <a href="{{ route('users.index') }}" class="btn rd-btn-default rd-btn-bold btn-sm">
                Back
            </a>

            <div class="btn-group">
                <button type="button" class="btn rd-btn-brand rd-btn-bold btn-sm">Save</button>
                <button type="button" class="btn rd-btn-brand rd-btn-bold btn-sm dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="rd-nav">
                        <li class="rd-nav__item">
                            <a href="#" class="rd-nav__link">
                                <i class="rd-nav__link-icon flaticon2-writing"></i>
                                <span class="rd-nav__link-text">Save &amp; continue</span>
                            </a>
                        </li>
                        <li class="rd-nav__item">
                            <a href="#" class="rd-nav__link">
                                <i class="rd-nav__link-icon flaticon2-medical-records"></i>
                                <span class="rd-nav__link-text">Save &amp; add new</span>
                            </a>
                        </li>
                        <li class="rd-nav__item">
                            <a href="#" class="rd-nav__link">
                                <i class="rd-nav__link-icon flaticon2-hourglass-1"></i>
                                <span class="rd-nav__link-text">Save &amp; exit</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

    <ul class="nav nav-fill rd-nav" role="tablist">
        <li class="nav-item rd-nav-item">
            <a class="nav-link rd-link active" data-toggle="tab" href="#rd_create_user_tab_1" role="tab">
                <div class="rd-nav-body">
                    <div class="rd-nav-number">
                        1
                    </div>
                    <div class="rd-nav-label">
                        <div class="rd-nav-label-title">
                            Profile
                        </div>
                        <div class="rd-nav-label-desc">
                            User's Personal Information
                        </div>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item rd-nav-item">
            <a class="nav-link rd-link" data-toggle="tab" href="#rd_create_user_tab_2" role="tab">
                <div class="rd-nav-body">
                    <div class="rd-nav-number">
                        2
                    </div>
                    <div class="rd-nav-label">
                        <div class="rd-nav-label-title">
                            Account
                        </div>
                        <div class="rd-nav-label-desc">
                            User's Account &amp; Settings
                        </div>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item rd-nav-item">
            <a class="nav-link rd-link" data-toggle="tab" href="#rd_create_user_tab_3" role="tab">
                <div class="rd-nav-body">
                    <div class="rd-nav-number">
                        3
                    </div>
                    <div class="rd-nav-label">
                        <div class="rd-nav-label-title">
                            Address
                        </div>
                        <div class="rd-nav-label-desc">
                            User's Shipping Address
                        </div>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item rd-nav-item">
            <a class="nav-link rd-link" data-toggle="tab" href="#rd_create_user_tab_4" role="tab">
                <div class="rd-nav-body">
                    <div class="rd-nav-number">
                        4
                    </div>
                    <div class="rd-nav-label">
                        <div class="rd-nav-label-title">
                            Permissions
                        </div>
                        <div class="rd-nav-label-desc">
                            Give permissions on user level
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>

    <div class="row">
        <div class="col-lg-12">

            <form method="POST" action="{{ route('users.store') }}" class="rd-form rd-form-label-right">
                @csrf
                @include('admin.user.form')
            </form>

        </div>
    </div>
</div>
@endsection
