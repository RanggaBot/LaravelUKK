@extends('layouts.layout')


@section('tittle', 'Dashboard Admin')
@section('content')
    <!-- Main Content -->
            <div id="content">
                {{-- Topbar --}}
                @if (session('success-login'))
                <div class="alert alert-success" role="alert" >
                    {{ session('success-login') }}
                  </div>
                @endif
                @if (session('success-register'))
                <div class="alert alert-success" role="alert" >
                    {{ session('success-register') }}
                  </div>
                @endif
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    {{-- Isi kontentnya --}}
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
