@php
    function limit_words($data, $count_words){
        $norm = strip_tags($data);
        $words = explode(' ', $norm);
        if( sizeof($words) > $count_words ) {
            $words = array_slice($words, 0, $count_words);
            $norm = implode(' ', $words) . '';
        }
        return $norm;
    }
@endphp