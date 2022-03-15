<html class="no-js" lang="en">
    @include('partials.layout.header')
    <style>
        .table-container {
            max-width: 1000px;
            margin-right:auto;
            margin-left:auto;
            padding: 20px 20px;
            display:flex;
            justify-content:left;
            /* align-items:center; */
            min-height:50vh;
        }

        .a {
            margin-bottom: 1rem;
        }

        .mark{
            min-width: 20px;
            vertical-align: top;
        }

        .SectionHeader {
            width: 100%;
            margin-top: auto !important;
            margin-bottom: unset !important;
            padding-top: 80px;
            header-height: unset !important;
        }


    </style>
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar')
        <main id="main" role="main">
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
