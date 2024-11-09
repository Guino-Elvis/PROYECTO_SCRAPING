@extends('errors::minimal')

@section('title', __('No autorizado'))
@section('code', '401')
@section('message', __('No tiene acceso a la información por no contar con los credenciales'))
