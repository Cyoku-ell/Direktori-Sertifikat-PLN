@extends('layouts.app')

@section('content')
    <div class="p-8">

        <div class="space-y-6">

            @include('pages.certificate.details.hero')

            @include('pages.certificate.details.owner')

            @include('pages.certificate.details.certificate')

            @include('pages.certificate.details.dates')

            @include('pages.certificate.details.document')

            @include('pages.certificate.details.remarks')

        </div>

    </div>
@endsection
