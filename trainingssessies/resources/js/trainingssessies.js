import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import nlLocale from '@fullcalendar/core/locales/nl';

let Trainingssessies = (function () {


    function AddCalender(events) {
        if (window.innerWidth >= 768 ) {
            var sessions = [];
            sessions = events
            const calendarEl = document.getElementById("calendar");
            let calendar = new Calendar(calendarEl, {
                contentHeight: 600,
                editable: true,
                locale: nlLocale,
                plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],

                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                }, events: sessions,
            });
            calendar.render();
        } else {
            var sessions = [];
            sessions = events
            const calendarEl = document.getElementById("calendar");
            let calendar = new Calendar(calendarEl, {
                editable: true,
                locale: nlLocale,
                plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],

                initialView: 'listWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: '',
                    right: ''
                },
              events: sessions,
            });
            calendar.render();
        }


    }




    return {
        AddCalender: AddCalender
    };
})();

export default Trainingssessies;
