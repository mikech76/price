@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Подбор токенов</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <textarea id="text" class="form-control" rows="8">
                                Кабель
                                Кабель             контрольный
                                 Кабель контрольный КГВВнг(А) 4х1.5
                                Кабель силовой КГ 4х2.5-380 Кабель силовой КГ 4х2.5-380   Кабель силовой КГ 4х2.5-380
                                Кабель силовой КГ    4х4
                                Кабель   силовой КГ 4х4-380
                                Кабель силовой КГ 4х6-380
                                Провод ПВСнг(А)-LS 3х1.5
                                Провод ПВСнг-LS 2х0.75(А)
                                Провод   ПВСнг(А)-LS   3х0.75
                                Провод силовой ПУГВ 1х0.5 голубой многопроволочный
                                Провод силовой ПУГВ 1х0.5 желто-зеленый многопроволочный
                                Кабель силовой   КГ    5х1.5-380 HoldFlex
                                Провод силовой ПУГВ 1х4 голубой    многопроволочный

                            </textarea>
                        </div>
                        <div class="form-group">
                            <button id="go" type="button" class="btn btn-success">Анализ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

        dd = console.log;

        window.onload = function () {

            $('#go').click(function () {
                let startTime = _.now();
                // все слова ключи
                let wK = {};
                // все слова значения
                let wS = [];
                // словосочетания
                let phrases = {};

                // строки
                _.forEach(_.split(_.toLower($("#text").val()), '\n'), function (line) {
                    if (_.trim(line)) {
                        // массив ключей слов данной строки
                        let tokens = [];
                        // слова
                        let words = _.chain(_.split(line, /[\s,;"'\/]/)).sort().sortedUniq().compact().value();
                        // перебираем слова в строке
                        _.forEach(words, function (word) {
                            // коллекция слов
                            let w = _.get(wK, word);
                            if (w) {
                                w.c++;
                            } else {
                                wS.push(word);
                                // i - индекс слова, c - счетчик слов

                                w = {i: wS.length - 1, c: 1};
                                wK[word] = w;
                            }
                            // токен как массив
                            tokens.push(w.i);
                        });


                        // перебираем все словосочетания
                        if (tokens.length > 1) {
                            for (let i = 0; i < tokens.length - 1; i++) {
                                for (let j = i + 2; j <= tokens.length; j++) {
                                    let token = _.join(_.slice(tokens, i, j), '-');

                                    // токен как объект коллекции
                                    let t = _.get(phrases, token);
                                    if (t) {
                                        t.c++;
                                    } else {
                                        phrases[token] = {c: 1}
                                    }
                                }
                            }
                        }
                    }
                });

                dd('in ' + ( _.now() - startTime) / 1000 + ' sec');

                  phrasesStat = [];
                _.forEach(phrases, function (t, token) {
                    // собираем токин из слов

                     let words = _.map(_.split(token, '-'), function (i) {
                        return wS[i];
                    });

                    phrasesStat.push({
                        token: _.join(words, ' '),
                        count: t.c,
                        length: words.length,
                    });
                });

                dd('out ' + ( _.now() - startTime) / 1000 + ' sec');

                phrasesStat = _.orderBy(phrasesStat, ['count', 'length'], ['desc', 'desc']);


                dd(wS.length);

                dd('sort ' + ( _.now() - startTime) / 1000 + ' sec');
            }).click();

        }

    </script>
@endsection
