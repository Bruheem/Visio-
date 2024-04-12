<table class="w-[100%] table font-bold text-xl  bg-base-300 bg-opacity-50 backdrop-blur transition-shadow duration-100 [transform:translate3d(5,0,0)] 
shadow-sm" style="z-index:60">
    <tr>
        @if ($domaine == 'ST')
            <td class="text-center  " colspan="{{ $companies->where('sector','ST')->count() }}">Domaine Scientifique</td>
        @elseif($domaine == 'MI')
            <td class="text-center  "  colspan="{{ $companies->where('sector','MI')->count() }}">Domaine Math</td>
        @else
        <td class="text-center  "  colspan="{{ $companies->where('sector','PR')->count() }}">Domaine Preparatoire</td>
        @endif
    </tr>
    <tr>
        {{-- foreach company --}}
        @foreach ($companies as $company)
            <td class="text-center  h-[100%] " >
                @include('weeks.company-header',['company'=>$company])
            </td>
        @endforeach
    </tr>
</table>


