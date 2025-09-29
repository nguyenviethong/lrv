@extends('adminlte::page')

@section('title', 'Cập nhật liên hệ mới')

@section('content_header')
    <h1>Cập nhật liên hệ mới</h1>
@stop

@section('content')
    <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $contact->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="hotline">Hotline</label>
                    <input type="text" name="hotline" id="hotline"
                           class="form-control @error('hotline') is-invalid @enderror"
                           value="{{ old('hotline', $contact->hotline) }}">
                    @error('hotline')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $contact->email) }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address"
                           class="form-control @error('address') is-invalid @enderror"
                           value="{{ old('address', $contact->address) }}">
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="zalo">Zalo</label>
                    <input type="text" name="zalo" id="zalo"
                           class="form-control @error('zalo') is-invalid @enderror"
                           value="{{ old('zalo', $contact->zalo) }}">
                    @error('zalo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook"
                           class="form-control @error('facebook') is-invalid @enderror"
                           value="{{ old('facebook', $contact->facebook) }}">
                    @error('facebook')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="4"
                              class="form-control @error('message') is-invalid @enderror">{{ old('message', $contact->message) }}</textarea>
                    @error('message')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật
                </button>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
@stop