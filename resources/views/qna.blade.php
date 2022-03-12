<html class="no-js" lang="en">
    @include('partials.layout.header')
    <style>
        .table-container {
            max-width: 1000px;
            margin-right:auto;
            margin-left:auto;
            display:flex;
            justify-content:left;
            align-items:center;
            min-height:50vh;
        }

        .a {
            margin-bottom: 1rem;
        }

        .mark{
            min-width: 20px;
        }

    </style>
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar')
        <main id="main" role="main">
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
                            <tr>
                                <td class="mark">A</td>
                                <td class="mark"> : </td>
                                <td>{{$item->faq_answer}}</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
        @include('partials.layout.footer')

        @include('partials.layout.script')
    </body>
</html>
