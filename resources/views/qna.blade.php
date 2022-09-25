@extends('store-theme._base')

@section('title', 'FAQ')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/qna.css') }}" />
@endpush

@section('body')
<div>
    <header class="SectionHeader SectionHeader--center">
        <div class="Container">
            <h3 class="SectionHeader__SubHeading Heading u-h6">FAQ</h3>
        </div>
    </header>
</div>
<div class="table-container">
    <div class="qna-container">
        @foreach ($faq as $item)
        <div class="q">
            <table>
                <tr>
                    <td class="mark">Q</td>
                    <td class="mark"> : </td>
                    <td>{{$item->faq_question}}</td>
                </tr>
            </table>
        </div>
        <div class="a">
            <table>
                <td>
                    <td class="mark">A</td>
                    <td class="mark"> : </td>
                    <td>{{$item->faq_answer}}</td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection
