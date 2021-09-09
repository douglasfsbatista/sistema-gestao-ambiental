<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar programação de visita') }}
        </h2>
    </x-slot>
    <div class="container" style="padding-top: 5rem; padding-bottom: 8rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-8">
                                <h5 class="card-title">Editar a visita à empresa {{$visita->requerimento->empresa->nome}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Programação > Visita > Editar visita</h6>
                            </div>
                        </div>
                        <div div class="form-row">
                            <div class="col-sm-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <form method="POST" id="editar-visita" action="{{route('visitas.update', $visita->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="data_marcada">{{ __('Data') }} <span style="color: red; font-weight: bold;">*</span></label>
                                    <input type="date" @error('data_marcada') is-invalid @enderror id="data_marcada" name="data_marcada" value="{{old('data_marcada')!=null ? old('data_marcada') : $visita->data_marcada}}" required autofocus autocomplete="data_marcada">
                                    @error('data_marcada')
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="requerimento">{{__('Selecione um requerimento ou denúncia')}}<span style="color: red; font-weight: bold;">*</span></label>
                                    <select name="requerimento"  id="requerimento" required class="form-select @error('requerimento') is-invalid @enderror">
                                        <option value="">-- {{__('Selecione um requerimento')}} --</option>
                                        @if (old('requerimento') != null)
                                            @foreach ($requerimentos as $requerimento)
                                                <option value="{{$requerimento->id}}" @if(old('requerimento') == $requerimento->id) selected @endif>{{$requerimento->empresa->nome}} @if($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['primeira_licenca'])
                                                    {{__('(primeira licença)')}}
                                                @elseif($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['renovacao'])
                                                    {{__('(renovação)')}}
                                                @elseif($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['autorizacao'])
                                                    {{__('(autorização)')}}
                                                @endif</option>
                                            @endforeach
                                        @else
                                            @foreach ($requerimentos as $requerimento)
                                                <option value="{{$requerimento->id}}" @if($visita->requerimento->id == $requerimento->id) selected @endif>{{$requerimento->empresa->nome}} @if($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['primeira_licenca'])
                                                    {{__('(primeira licença)')}}
                                                @elseif($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['renovacao'])
                                                    {{__('(renovação)')}}
                                                @elseif($requerimento->tipo == \App\Models\Requerimento::TIPO_ENUM['autorizacao'])
                                                    {{__('(autorização)')}}
                                                @endif</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="form-row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6" style="text-align: right">
                                <button type="submit" class="btn btn-success" form="editar-visita" style="width: 100%">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
