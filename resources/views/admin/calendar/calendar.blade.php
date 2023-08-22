@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body" style="height: 100vh; padding: 0px;">
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
            <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href="{{ asset('css/editcalendar.css') }}">
          
            <div class="row" style="height: 100vh;">
                <div class="col-md-3 col-sm-12">
                    <div class="btn-group m-auto calendar-type">
                        <button type="button" id="dayView" class="btn btn-outline-primary">Dnevni</button>
                        <button type="button" id="weekView" class="btn btn-outline-primary">Tjedni</button>
                        <button type="button" id="monthView" class="btn btn-outline-primary">Mjesečni</button>
                    </div>

                    <div class="row m-auto calendar-btn">
                        <div class="col-sm-8 col-8">
                            <h5 id="calendarTitle"></h5>
                        </div>
                        <div class="col-sm-4 col-4">
                            <div class="btn-group d-flex justify-content-end">
                                <button type="button" id="prev" class="btn btn-light"><i
                                        class="fa fa-chevron-left"></i></button>
                                <button type="button" id="next" class="btn btn-light"><i
                                        class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row m-auto">
                        <button type="button" id="to_today" class="btn btn-primary">Idi na danas</button>
                    </div>

                    <div class="row m-auto" id='minicalendar'>
                        <div class="wrapperi">
                            <div id="calendari"></div>
                        </div>
                        {{-- @include('admin.calendar.minicalendar') --}}
                    </div>

                    <div class="row m-auto">
                        <div class="col">
                            <input type="text" id="sch_patient" class="form-control text-center"
                                placeholder="&#xf007; Pretraži pacijenta" style="font-family: 'Font Awesome 5 Free';">
                        </div>
                    </div>

                    <div class="doctor_panel">
                        <label class="doctor_label" for="checklist">Doktori</label>
                        <div id="checklist">
                            @foreach ($doctors as $id => $doctor)
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" id="doctor_checked{{ $id }}"
                                        name="" value="" checked>
                                    <label class="form-check-label">{{ $doctor }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="div1" class="col-md-9 col-sm-12" style="height: 95vh;">
                    <div id='calendar' class="m-auto" style="width: 90%;">
                        <button type="button" id="addTerminus" class="btn btn-lg btn-circle btn-primary"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </div>


                <div id="div2" class="col-0" style="display: none; height: 90vh; padding-right: 70px;">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active">Upisi pacijenta</a>
                        </li>
                    </ul>
                    <div class="mt-1">
                        <h4 id="eventDate" style="display: inline"></h4>
                        <form class="input-group" style="display: inline">
                            <input class="date" type="text" name="eventDate_virtual" id="eventDate_virtual" />
                            <label for="date_picker" class="btn" id="eventDate_handler">
                                <i class="fa fa-chevron-down"></i>
                            </label>
                        </form>
                    </div>

                    <div class="row btn-group mb-2" style="float: left;">
                        <span class="btn btn-light btn-sm btn-circle mr-2" id="minus_btn1"><i
                                class="fa fa-minus"></i></span>
                        <h5><span id="start_time_display"></span> - <span id="finish_time_display"></span></h5>
                        <span class="btn btn-light btn-sm btn-circle ml-2" id="plus_btn1"><i class="fa fa-plus"></i></span>
                    </div>

                    <form method="POST" action="{{ route('admin.terminus.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user" style="color: #0c58c9"></i></span>
                            </div>
                            <select class="form-control {{ $errors->has('pacjent') ? 'is-invalid' : '' }}"
                                name="pacjent_id" id="pacjent_id" required>
                                @foreach ($pacjents as $id => $entry)
                                    <option value="{{ $id }}" {{ old('pacjent_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('pacjent'))
                                <span class="text-danger">{{ $errors->first('pacjent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.terminu.fields.pacjent_helper') }}</span>
                        </div>
                        <div class="container mb-2 addPanel">
                            <div class="row">
                                <div class="col-5">
                                    <label for="pocinje">Pocinje</label>
                                    <div class="input-group input-group-sm">
                                        <span class="btn btn-sm btn-light" id="minus_btn2"><i
                                                class="fa fa-minus"></i></span>
                                        <input type="hidden" name="start_time" id="start_time" />
                                        <select class="form-control" type='text' name="start_time_virtual"
                                            id="start_time_virtual">
                                        </select>
                                        <span
                                            class="help-block">{{ trans('cruds.terminu.fields.start_time_helper') }}</span>
                                        <span class="btn btn-sm btn-light" id="plus_btn2"><i
                                                class="fa fa-plus"></i></span>
                                    </div>
                                    @if ($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_tim') }}</span>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <label for="karta">Dentalni karta</label>
                                    @php
                                        $zubi = ['Odaberi...', 18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28, 48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38];
                                    @endphp
                                    <select class="form-control form-select-sm" name="selected_teeth[]" id="zubi_id"
                                        required>
                                        @foreach ($zubi as $zub)
                                            <option>{{ $zub }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="pocinje">Trajanje</label>
                                    <div class="input-group input-group-sm">
                                        <span class="btn btn-sm btn-light" id="minus_btn3"><i
                                                class="fa fa-minus"></i></span>
                                        <input type="hidden" name="finish_time" id="finish_time" />
                                        <select class="form-control" name="finish_time_virtual" id="finish_time_virtual">
                                        </select>
                                        <span
                                            class="help-block">{{ trans('cruds.terminu.fields.finish_time_helper') }}</span>
                                        <span class="btn btn-sm btn-light" id="plus_btn3"><i
                                                class="fa fa-plus"></i></span>
                                    </div>
                                    @if ($errors->has('finish_time'))
                                        <span class="text-danger">{{ $errors->first('finish_time') }}</span>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <label for="doktor">Doktor</label>
                                    <select
                                        class="form-control  form-select-sm {{ $errors->has('zaposlenik') ? 'is-invalid' : '' }}"
                                        name="zaposlenik_id" id="zaposlenik_id">
                                        @foreach ($zaposleniks as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ old('zaposlenik_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('zaposlenik'))
                                        <span class="text-danger">{{ $errors->first('zaposlenik') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.terminu.fields.zaposlenik_helper') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="pocinje"></label>
                                </div>
                                <div class="col-8">
                                    <div class="button-group">
                                        <button class="btn btn-sm btn-outline-primary ml-2" style="float: right;"
                                            id="submit_btn1">Potvrdi</button>
                                        <button class="btn btn-sm btn-outline-secondary"
                                            style="float: right;">Odustani</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="checkroom">Slanje obavijesti</label>
                            <div class="row" id="checkroom">
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" id="whatsapp" name="option1"
                                        value="something" checked>
                                    <label class="form-check-label">Whatsapp</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input" type="checkbox" id="email" name="option1"
                                        value="something" checked>
                                    <label class="form-check-label">email</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="komentar">Napomena:</label>
                            <textarea class="form-control mb-2 {{ $errors->has('komentar') ? 'is-invalid' : '' }}" rows="3" id="komentar"
                                name="komentar" placeholder="Dodaj napomenu"></textarea>
                            @if ($errors->has('komentar'))
                                <span class="text-danger">{{ $errors->first('komentar') }}</span>
                            @endif
                        </div>

                        <div class="row submit_panel">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <div class="button-group">
                                    <button type="submit" class="btn btn-outline-primary mr-2" id="submit_btn2"
                                        style="float:right;">Spremi</button>
                                    <button type="button" class="btn btn-secondary mr-3" id="clcTerminus"
                                        style="float:right;">Zatvari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/hr.js'></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>

    <script>
        var mesos = ['siječanj', 'veljača', 'ožujak', 'travanj', 'svibanj', 'lipanj', 'srpanj', 'kolovoz', 'rujan',
            'listopad', 'studeni', 'prosinac'
        ];

        var dies = ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'];

        var dies_abr = ['NED', 'PON', 'UTO', 'SRI', 'ČET', 'PET', 'SUB'];

        var widgetCalendar = document.getElementById('calendari');

        var dateCalendar = new Date();

        Number.prototype.pad = function(num) {
            var str = '';
            for (var i = 0; i < (num - this.toString().length); i++)
                str += '0';
            return str += this.toString();
        }

        // Add panels
        var today = new Date();
        var weekday = today.toLocaleString('default', {
            weekday: 'short'
        });

        // Format the date components
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear().toString();
        // Add leading zeros to day and month if needed
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        document.getElementById("eventDate").innerHTML = weekday + ", " + day + "." + month + "." + year + ".";

        // FullCalendar
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            calendari(document.getElementById('calendari'), dateCalendar);

            var events = {!! json_encode($events) !!};
            console.log(events);
            var doctors = {!! json_encode($doctors) !!};

            var calendar = $('#calendar').fullCalendar({
                events: events,
                defaultView: 'month',
                locale: 'hr',
                slotDuration: '00:15',
                slotLabelFormat: 'HH:mm',
                header: false,
                timeFormat: 'H:mm', // 24-hour format
                allDaySlot: false, // remove all-day slot
                minTime: '08:00:00', // set calendar start time to 8:00
                maxTime: '20:30:00',
                viewRender: function(view) {
                    $('#calendarTitle').text(view.title);
                },
                eventRender: function(event, element) {
                    var eventStart = moment(event.start).format('H:mm');
                    var eventEnd = moment(event.end, "DD.MM.YYYY HH:mm").format('H:mm');
                    if (event.doctor === 4) {
                        element.addClass('colored-event');
                    }
                    element.find('.fc-time').html(eventStart + ' - ' + eventEnd + '<br>');
                },
            });

            var filteredEvents = [];

            $('#doctor_checked1, #doctor_checked4').on('click', function() {
                var isChecked1 = $('#doctor_checked1').is(":checked");
                var isChecked4 = $('#doctor_checked4').is(":checked");
                if (isChecked1 === false && isChecked4 === true) {
                    filteredEvents = events.filter(item => item.doctor !== 1);
                } else if (isChecked1 === true && isChecked4 === false) {
                    filteredEvents = events.filter(item => item.doctor !== 4);
                } else if (isChecked1 === true && isChecked4 === true) {
                    filteredEvents = events;
                } else {
                    filteredEvents = events.filter(item => item.doctor !== 4 && item.doctor !== 1);
                }
                calendar.fullCalendar('removeEvents');
                calendar.fullCalendar('addEventSource', filteredEvents);
            });
            // });

            updateButtonState();

            // Add click event for day view button
            $('#dayView').click(function() {
                calendar.fullCalendar('changeView', 'agendaDay');
                updateButtonState();
            });

            // Add click event for week view button
            $('#weekView').click(function() {
                calendar.fullCalendar('changeView', 'agendaWeek');
                updateButtonState();
            });

            // Add click event for month view button
            $('#monthView').click(function() {
                calendar.fullCalendar('changeView', 'month');
                updateButtonState();
            });

            // Add click event for prev button
            $('#prev').click(function() {
                calendar.fullCalendar('prev');
                updateButtonState();
                // control mini-calendar
                var view = calendar.fullCalendar('getView');
                if (view.name === 'month') {
                    dateCalendar.setMonth(dateCalendar.getMonth() - 1);
                    calendari(widgetCalendar, dateCalendar);
                }
            });

            // Add click event for next button
            $('#next').click(function() {
                calendar.fullCalendar('next');
                updateButtonState();
                // control mini-calendar
                var view = calendar.fullCalendar('getView');
                if (view.name === 'month') {
                    dateCalendar.setMonth(dateCalendar.getMonth() + 1);
                    calendari(widgetCalendar, dateCalendar);
                }
            });

            //search
            $('#sch_patient').on('change', function() {
                var searchValue = $(this).val();
                const newevents = [];
                events.forEach(event => {
                    if (event.title.includes(searchValue)) {
                        newevents.unshift(event);
                    }
                });
                calendar.fullCalendar('removeEvents'); // Remove existing events
                calendar.fullCalendar('addEventSource', newevents); // Add new events
                calendar.fullCalendar('rerenderEvents');
            });

            // Add click event for today button
            $('#to_today').click(function() {
                calendar.fullCalendar('today');
                updateButtonState();
                calendari(widgetCalendar, today);
            });

            // Current weekday
            var currentDay = today.getDay();
            if (currentDay === 0) {
                currentDay = 7;
            }

            function addCurrentDayClass() {
                const thElements = document.querySelectorAll('thead th');
                thElements.forEach((th, index) => {
                    if (index === currentDay - 1) {
                        th.classList.add('current-day');
                    } else if (index < currentDay - 1) {
                        th.classList.add('prev-day');
                    }
                });
            }

            function addAxisElementClass() {
                const axisElements = document.querySelectorAll('tbody tr');
                axisElements.forEach((axis, index) => {
                    if (index % 4 === 2) {
                        axis.firstElementChild.classList.add('full_hour');
                    }
                    if (index % 4 === 0) {
                        axis.firstElementChild.classList.add('half_hour');
                    }
                });
            }

            addCurrentDayClass();

            function updateButtonState() {
                var view = calendar.fullCalendar('getView');
                $('.btn-outline-primary').removeClass('active');
                if (view.name === 'agendaDay') {
                    $('#dayView').addClass('active');
                    addAxisElementClass();
                    addCurrentDateClass(view);
                } else if (view.name === 'agendaWeek') {
                    $('#weekView').addClass('active');
                    addAxisElementClass();
                    addCurrentWeekClass();
                } else if (view.name === 'month') {
                    $('#monthView').addClass('active');
                    $('.fc-day-grid-event').addClass('month_event');
                    const thElements = document.querySelectorAll('thead th');
                    thElements.forEach((th, index) => {
                        th.innerHTML = th.innerHTML.replace('.', '');
                        var title_content = view.title.split(' ');
                        var month_part = title_content[0];
                        var month_index = mesos.indexOf(month_part);
                        var year_part = title_content[1];
                        if (year_part == today.getFullYear() && month_index == today.getMonth()) {
                            if (index === currentDay - 1) {
                                th.classList.add('current-day');
                            } else if (index < currentDay - 1) {
                                th.classList.add('prev-day');
                            }
                        } else if (year_part < today.getFullYear() || year_part == today.getFullYear() &&
                            month_index < today.getMonth()) {
                            th.classList.add('prev-day');
                        }
                    });

                }
            }

            // Add click event for addTerminus button
            $("#addTerminus").click(function() {
                // window.location.href = "{{ route('admin.terminus.create') }}";
                $("#div1").removeClass("col-md-9 col-sm-12").addClass("col-md-5 col-sm-12");
                $("#div2").addClass("col-md-4 col-sm-12")
                    .show();
                // Assuming div2 has display: none initially
                document.getElementById("addTerminus").style.display = "none";
                document.getElementById("div2")
                    .style.display = "block";
            });

            $("#clcTerminus").click(function() {
                $("#div1").removeClass("col-md-5 col-sm-12").addClass("col-md-9 col-sm-12");
                $("#div2").removeClass("col-md-4 col-sm-12").hide();
                // Hide the div again
                document.getElementById("addTerminus").style.display = "block";
                document.getElementById("div2").style.display = "none";
            });
        });

        function addCurrentDateClass(view) {
            const dayaxis_element = document.querySelectorAll('thead th');
            dayaxis_element.forEach((th, index) => {
                if (index > 0) {
                    var weekday_part = th.querySelector('span').innerHTML.replace('. ', '');
                    var week_index = dies.indexOf(weekday_part);
                    var title_content = view.title.split('.');
                    var date_part = title_content[0];
                    var monthyear_part = title_content[1];
                    var month_part = monthyear_part.split(' ')[1];
                    var month_index = mesos.indexOf(month_part);
                    th.innerHTML = '<p style="font-size: 0.5em; margin-top:0.5em;">' +
                        dies_abr[week_index] + '</p>' + '<p style="font-size: 1.2em;">' +
                        date_part +
                        '</p>';
                    if (date_part == today.getDate() && month_index == today.getMonth()) {
                        th.classList.add('current-day');
                    }
                    if (month_index < today.getMonth() || date_part < today.getDate() &&
                        month_index == today.getMonth()) {
                        th.classList.add('prev-day');
                    }
                }
            });
        }

        function addCurrentWeekClass() {
            const weekaxis_element = document.querySelectorAll('thead th');
            weekaxis_element.forEach((th, index) => {
                if (index > 0) {
                    var spanContent = th.querySelector('span').innerHTML;
                    var sliced_element = spanContent.split('. ');
                    var weekday_part = sliced_element[0];
                    var monthday_part = sliced_element[1];
                    var month_part = monthday_part.split('/')[0];
                    var date_part = monthday_part.split('/')[1];
                    th.innerHTML = '<p style="font-size: 0.5em; margin-top:0.5em;">' +
                        weekday_part + '</p>' + '<p style="font-size: 1.2em;">' + date_part +
                        '</p>';
                    if (date_part == today.getDate() && month_part == today.getMonth() + 1) {
                        th.classList.add('current-day');
                    }
                    if (month_part < today.getMonth() + 1 || date_part < today.getDate() &&
                        month_part == today.getMonth() + 1) {
                        th.classList.add('prev-day');
                    }
                }
            });
        }

        // Mini-Calendar
        function calendari(widget, data) {

            var original = widget.getElementsByClassName('actiu')[0];

            if (typeof original === 'undefined') {
                original = document.createElement('table');
                original.setAttribute('data-actual',
                    data.getFullYear() + '/' +
                    data.getMonth().pad(2) + '/' +
                    data.getDate().pad(2))
                widget.appendChild(original);
            }

            var diff = data - new Date(original.getAttribute('data-actual'));

            diff = new Date(diff).getMonth();

            var e = document.createElement('table');

            e.className = diff === 0 ? 'amagat-esquerra' : 'amagat-dreta';
            e.innerHTML = '';

            widget.appendChild(e);

            e.setAttribute('data-actual',
                data.getFullYear() + '/' +
                data.getMonth().pad(2) + '/' +
                data.getDate().pad(2))

            var fila = document.createElement('tr');
            var titol = document.createElement('th');
            titol.setAttribute('colspan', 7);

            var boto_prev = document.createElement('button');
            boto_prev.id = 'prev';
            boto_prev.innerHTML = '&#9666;';

            var boto_next = document.createElement('button');
            boto_next.className = 'boto-next';
            boto_next.innerHTML = '&#9656;';

            titol.appendChild(boto_prev);
            titol.appendChild(document.createElement('span')).innerHTML =
                mesos[data.getMonth()] + '<span class="any">' + data.getFullYear() + '</span>';

            titol.appendChild(boto_next);

            boto_prev.onclick = function() {
                $('#prev').trigger('click');
                data.setMonth(data.getMonth() - 1);
                calendari(widget, data);
            };

            boto_next.onclick = function() {
                $('#next').trigger('click');
                data.setMonth(data.getMonth() + 1);
                calendari(widget, data);
            };

            fila.appendChild(titol);
            e.appendChild(fila);

            fila = document.createElement('tr');

            for (var i = 1; i < 7; i++) {
                fila.innerHTML += '<th>' + dies_abr[i] + '</th>';
            }

            fila.innerHTML += '<th>' + dies_abr[0] + '</th>';
            e.appendChild(fila);

            /* Obtinc el dia que va acabar el mes anterior */
            var inici_mes =
                new Date(data.getFullYear(), data.getMonth(), -1).getDay();

            var actual = new Date(data.getFullYear(),
                data.getMonth(),
                -inici_mes);

            /* 6 setmanes per cobrir totes les posiblitats
             *  Quedaria mes consistent alhora de mostrar molts mesos 
             *  en una quadricula */
            for (var s = 0; s < 6; s++) {
                var fila = document.createElement('tr');
                for (var d = 1; d < 8; d++) {
                    var cela = document.createElement('td');
                    var span = document.createElement('span');
                    cela.appendChild(span);
                    span.innerHTML = actual.getDate();
                    if (actual.getMonth() !== data.getMonth())
                        cela.className = 'fora';
                    /* Si es avui el decorem */
                    if (data.getDate() == actual.getDate() &&
                        data.getMonth() == today.getMonth()) {
                        cela.className = 'avui';
                    }
                    actual.setDate(actual.getDate() + 1);

                    cela.addEventListener('click', function() {
                        var activeElements = widget.getElementsByClassName('avui_outlined');
                        for (var j = 0; j < activeElements.length; j++) {
                            activeElements[j].classList.remove('avui_outlined');
                        }
                        this.classList.add('avui_outlined');
                        var clickedDate = new Date(data.getFullYear(), data.getMonth(), this.querySelector('span')
                            .innerHTML);
                        let month = clickedDate.getMonth() + 1;
                        if (month < 10) {
                            month = "0" + month;
                        }
                        let date = clickedDate.getDate();
                        if (date < 10) {
                            date = "0" + date;
                        }
                        var dateString = clickedDate.getFullYear() + '-' + month + '-' + date;
                        $('#calendar').fullCalendar('gotoDate', dateString);
                        var view = $('#calendar').fullCalendar('getView');
                        if (view.name === 'agendaDay') {
                            addCurrentDateClass(view);
                        } else if (view.name === 'agendaWeek') {
                            addCurrentWeekClass();
                        }
                    });

                    fila.appendChild(cela);
                }
                e.appendChild(fila);
            }

            setTimeout(function() {
                e.className = 'actiu';
                original.className +=
                    diff === 0 ? ' amagat-dreta' : ' amagat-esquerra';
            }, 20);

            original.className = 'inactiu';

            setTimeout(function() {
                var inactius = document.getElementsByClassName('inactiu');
                for (var i = 0; i < inactius.length; i++)
                    widget.removeChild(inactius[i]);
            }, 0000);

        }

        // Create panel
        var timeArray = [];

        // Set the initial time to 06:00
        var hours = 6;
        var minutes = 0;

        // TimeArray with 30min time interval
        for (let i = 0; i < 34; i++) {
            // Format the time as HH:MM
            var formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
            // Add the formatted time to the array
            timeArray.push(formattedTime);
            // Increment the minutes by 30
            minutes += 30;
            // If minutes reach 60, increment the hours and reset minutes to 0
            if (minutes === 60) {
                hours++;
                minutes = 0;
            }
        }

        var start_time_select = document.getElementById("start_time_virtual");
        var end_time_select = document.getElementById("finish_time_virtual");

        // Loop through the timeArray and create <option> elements
        for (let i = 0; i < timeArray.length; i++) {
            // Create a new <option> element
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            // Set the value and text of the <option> element
            option1.value = timeArray[i];
            option2.value = timeArray[i];
            option1.text = timeArray[i];
            option2.text = timeArray[i];
            // Append the <option> element to the select box
            start_time_select.appendChild(option1);
            end_time_select.appendChild(option2);
        };

        // Initial start_time 08:00
        start_time_select.selectedIndex = 4;

        const startTimeInput = document.getElementById('start_time_virtual');
        const finishTimeInput = document.getElementById('finish_time_virtual');

        // Retrieve the start time display element
        const startTimeDisplay = document.getElementById('start_time_display');
        const finishTimeDisplay = document.getElementById('finish_time_display');

        // Get the Date input element by its ID
        const handle = document.getElementById('eventDate_virtual');

        // Add an event listener for the 'change' event
        handle.addEventListener('blur', () => {
            const value = handle.value;
            const [event_day, event_month, event_year] = value.split('.');
            day = event_day;
            month = event_month;
            year = event_year;
            const eventDate = new Date(`${event_month}/${event_day}/${event_year}`);
            const weekday = eventDate.getDay();
            const weekdayName = dies_abr[weekday];
            document.getElementById("eventDate").innerHTML = weekdayName + ', ' + value;
            $('#start_time').val(day + "." + month + "." + year + " " + startTimeInput.value);
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTimeInput.value);
        });

        function start_time_req() {
            startTimeDisplay.textContent = startTimeInput.value;
            $('#start_time').val(day + "." + month + "." + year + " " + startTimeInput.value);
            finishTimeInput.value = calculateFinishTime(startTimeInput.value);
            finishTimeDisplay.textContent = finishTimeInput.value;
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTimeInput.value);
        }

        start_time_req();

        $('#minus_btn1, #minus_btn2').click(function() {
            var value = $("#start_time_virtual").val();
            var indexNum = timeArray.indexOf(value);
            start_time_select.selectedIndex = indexNum - 1;
            start_time_req();
        });
        $('#plus_btn2').click(function() {
            var value = $("#start_time_virtual").val();
            var indexNum = timeArray.indexOf(value);
            start_time_select.selectedIndex = indexNum + 1;
            start_time_req();
        });
        $('#plus_btn1, #plus_btn3').click(function() {
            var value = $("#finish_time_virtual").val();
            var indexNum = timeArray.indexOf(value);
            end_time_select.selectedIndex = indexNum + 1;
            finishTimeDisplay.textContent = finishTimeInput.value;
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTimeInput.value);
        });
        $('#minus_btn3').click(function() {
            var value = $("#finish_time_virtual").val();
            var indexNum = timeArray.indexOf(value);
            end_time_select.selectedIndex = indexNum - 1;
            finishTimeDisplay.textContent = finishTimeInput.value;
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTimeInput.value);
        });

        $('#start_time_virtual').on('change', function() {
            var startTime = $(this).val();
            finishTime = calculateFinishTime(startTime);
            $('#finish_time_virtual').val(finishTime);
            finishTimeDisplay.textContent = finishTime;
            $('#start_time').val(day + "." + month + "." + year + " " + startTime);
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTime);
        });
        $('#finish_time_virtual').on('change', function() {
            var finishTime = $(this).val();
            $('#finish_time_virtual').val(finishTime);
            $('#finish_time').val(day + "." + month + "." + year + " " + finishTime);
        });

        function calculateFinishTime(startTime) {
            var start = new Date('1970-01-01 ' + startTime);
            var finish = new Date(start.getTime() + 30 * 60000); // Add 30 minutes (30 * 60 * 1000 milliseconds)
            var finishTime = finish.toTimeString().slice(0, 5); // Extract the time portion (HH:mm)
            return finishTime;
        };

        // Add an event listener to update the display when the input value changes
        startTimeInput.addEventListener('input', function() {
            startTimeDisplay.textContent = startTimeInput.value;
        });
        finishTimeInput.addEventListener('input', function() {
            finishTimeDisplay.textContent = finishTimeInput.value;
        });

        // Connetion with calendar
        document.getElementById('eventDate_handler').addEventListener('click', function() {
            document.getElementById('eventDate_virtual').focus();
        });
    </script>
@stop
