@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')

    <p><strong><small>Super User Credentials</small></strong></p>
    <pre>
        <code>
            Username: super_user@app.dev<br/>
            Password: super_user
        </code>
    </pre>
    <p><small><i><span style="color: red">*</span> Please change this password once you log in for the first time.</i></small></p><br />

	@if(session('message')['dbOutputLog'])
		<p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
		<pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
	@endif

	<!-- <p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
	<pre><code>{{ $finalMessages }}</code></pre>

	<p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p>
	<pre><code>{{ $finalStatusMessage }}</code></pre> 

	<p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p>
	<pre><code>{{ $finalEnvFile }}</code></pre> -->

    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>

@endsection
