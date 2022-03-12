<html class="no-js" lang="en">
    @include('partials.layout.header')
    <style>
        .table-container {
            max-width: 1000px;
            margin-right:auto;
            margin-left:auto;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:50vh;
        }
    </style>
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar')
        <main id="main" role="main">
            <p><span style="font-weight: 400;">Q &amp; A</span></p>
            <div class="table-container">
                <div class="qna-container">
                    @foreach ($faq as $item)
                    <div class="q">
                        <table>
                            <th>
                                <tr>Q</tr>
                                <tr> : </tr>
                                <tr>{{$item->faq_question}}</tr>
                            </th>
                        </table>
                    </div>
                    <div class="a">
                        <table>
                            <th>
                                <tr>A</tr>
                                <tr> : </tr>
                                <tr>{{$item->faq_answer}}</tr>
                            </th>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
        @include('partials.layout.footer')

        @include('partials.layout.script')
    </body>
</html>
