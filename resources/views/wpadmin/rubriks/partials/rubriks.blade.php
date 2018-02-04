@foreach($rubriks as $rubrik_list)

    <option value="{{$rubrik_list->id or ""}}"
{{--
        @isset($rubrik->id)

            @if($rubrik->parent_id == $rubrik_list->id)
                selected=""
            @endid

            @if($rubrik->id == $rubrik_list->id)
            hidden=""
            @endid

        @endisset
      --}}
    >
        {!! $delimiter or "" !!}{{$rubrik_list->name_ru or ""}}
    </option>

    @if (count($rubrik_list->children) > 0)

        @include('wpadmin.rubriks.partials.rubriks', [
            'rubriks'   => $rubrik_list->children,
            'delimiter' => ' - ' . $delimiter
        ])

    @endif
@endforeach