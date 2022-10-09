@extends('layouts.admin')
@section('title','Site Ayarları')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ route('admin.settings.store') }}" method="POSt">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="text-black-50 mb-0">Site - Genel Ayarlar</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="website_name">Site Adı</label>
                                <input type="text" name="website_name" id="website_name" value="{{ $setting->website_name ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="website_url">Site Url</label>
                                <input type="text" name="website_url" id="website_url" value="{{ $setting->website_url ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="website_title">Sayfa Başlığı</label>
                                <input type="text" name="website_title" id="website_title" value="{{ $setting->website_title ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keywords">Meta Kelimeler</label>
                                <input type="text" name="meta_keyword" id="meta_keyword" value="{{ $setting->meta_keyword ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_description">Meta Açıklama</label>
                                <input type="text" name="meta_description" id="meta_description" value="{{ $setting->meta_description ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="text-black-50 mb-0">Site - Bilgileri</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="address">Adres</label>
                                <textarea name="address" id="address" class="form-control">{{ $setting->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone1">Telefon - 1</label>
                                <input type="text" name="phone1" id="phone1" value="{{ $setting->phone1 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone2">Telefon - 2</label>
                                <input type="text" name="phone2" id="phone2" value="{{ $setting->phone2 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email1">Email - 1</label>
                                <input type="email" name="email1" id="email1" value="{{ $setting->email1 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email2">Email - 2</label>
                                <input type="email" name="email2" id="email2" value="{{ $setting->email2 ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="text-black-50 mb-0">Site - Sosyal Medya</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" id="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="twitter">Twitter</label>
                                <input type="text" name="twitter" id="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="instagram">İnstagram</label>
                                <input type="text" name="instagram" id="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="youtube">Youtube</label>
                                <input type="text" name="youtube" id="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-white">Kaydet</button>
                </div>
            </form>

        </div>
    </div>
@endsection

