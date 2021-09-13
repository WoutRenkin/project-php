@extends('layouts.template')

@section('main')
    @include('shared.notificationnav')

    <div id="page" class="container mt-4">
        <div id="sessionMessage" class="alert alert-success shadow d-none" role="alert"></div>
        <div class="card-body">
            <div class="row align-items-center ">

                <select class="col-sm-3 custom-select w-50 mb-4" id="NotificationsFilter">
                    <option value="1">Ongelezen meldingen</option>
                    <option value="2">Gelezen meldingen</option>
                </select>
                <div class="col-sm-3 w-50 mb-4">
                    <input type="text" class="form-control" name="myinput" id="myInput" value="" placeholder="Filter op naam">
                </div>
                <label class="mb-4 mr-1" > Meldingen:</label>
                <select class="col-sm-1 custom-select w-25 mb-4" id="PerPageFilter">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="all">Alle</option>
                </select>
                <label class="mb-4 ml-1" > per pagina</label>

                {{--     <div class="custom-control custom-switch col-sm-4 mb-4">
                         <label class="custom-control-label" for="customSwitch1">Meldingen</label>
                         <input type="checkbox" class="custom-control-input" id="customSwitch1">
                     </div>--}}
            </div>

            <div class="row justify-content-center"></div>
            <div id="notifications">
            </div>
            <div id="NoNotifications">
            </div>
            <div class="row mt-4">
                <div class="col-sm-4 mb-4">
                    <button class="btn btn-primary" id="moreNotifications" data-toggle="tooltip" title="Laad extra meldingen">Meer meldingen <i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </div>
        <hr>
        <a href="#" class="markAsRead" data-id="mark-all">
            Markeer alle meldingen als gelezen.
        </a>
    </div>
    </div>
    <script>
        //Default page = 1
        let page = 1;

        //Notification per page
        let perPage = 10

        //Assign morenotifications to false, we will check this variable later to see if we have to clear our notifications div
        let moreNotifications = false;

        //get the value of the new notifications bell in our navbar so we can dynamically update it when new notifications get read.
        let notificationCount = $('#selfevaluationNav').data("count");
        let notificationMainNav = $('#mainNavNotifications').data("count");

        $(function () {

            //On initialization we want to get the notifications.
            loadNotifications();

            //hide our session message, we will only show it when an action has taken place.
            $('#sessionMessage').hide();

            //Onchange for our filter, we load our notifications again so we want to put the page back to 1 so we load the latest messages only.
            //Set more notifications to false again because we don't want to append the notifications to the currently showing ones.
            $('#NotificationsFilter').on('change', function () {
                page = 1;
                moreNotifications = false;
                loadNotifications()
            });

            //How many notifications we want to see perPage
            $('#PerPageFilter').on('change', function () {
                page = 1;
                perPage = $(this).val()
                moreNotifications = false;

                loadNotifications()
            });

            //This is our filter function so we can search for a name, date, ....
            $(function () {
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#notifications .alert").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });

            //our click function looks like this because these buttons are dynamically created.
            //We check if notifications div is empty so we aren't reloading the page when clicking on mark all button
            //Call postmarkread function with value of button clicked, this id is the id of the notification we want to mark as read.
            $(document).on('click', '.markAsRead', function () {
                if (!$('#notifications').is(':empty')) {

                    postMarkRead($(this).data("id"));
                }
            });

            //function to load more notifications. We will do page +1 because we want to add the next page of our pagination object.
            //More notifications to true since we want to append our messages to the current messages.
            $( "#moreNotifications" ).click(function() {
                page++
                moreNotifications = true;
                loadNotifications()
            });

        });

        //Our post function, we will post to the laravel controller the message we marked as read or mark all if mark all button is pressed.
        function postMarkRead(id) {
            $.ajax({
                url: 'selfevaluation/markAsRead',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    'id': id
                },
                success: function (data) {
                    $('#sessionMessage').removeClass("d-none");
                    //If post was successful, show session message as a success session.
                    //If laravel response was mark-all we reload our notifications (all will disappear)
                    //If laravel response wasn't mark-all we just remove the message with the id of the laravel response.
                    $('#sessionMessage').addClass("alert-success");
                    $('#sessionMessage').removeClass("alert-danger");
                    if (data.marked === "mark-all") {
                        $('#sessionMessage').html("Je hebt alle mededeling succesvol gemarkeerd als gelezen.");
                        loadNotifications();
                        notificationMainNav = notificationMainNav - notificationCount;
                        notificationCount = 0;
                    } else {
                        $('#sessionMessage').html("Melding succesvol gemarkeerd als gelezen.");
                        notificationCount = notificationCount - 1;
                        notificationMainNav = notificationMainNav -1;
                        $(`a[data-id=${id}]`).closest('.alert').remove();
                    }
                    $('#selfevaluationNav').attr('data-count',notificationCount)
                    $('#mainNavNotifications').attr('data-count',notificationMainNav)
                    $('#navDropSelfEvaluation').html(notificationCount)
                    $('#sessionMessage').show();
                    timeOutFunction()
                },
                error: function (e) {
                    $('#sessionMessage').removeClass("d-none");
                    $('#sessionMessage').html("Er is iets fout gegaan, probeer opnieuw!");
                    $('#sessionMessage').removeClass("alert-success");
                    $('#sessionMessage').addClass("alert-danger");

                }
            })
        }

        //Way to load our notifications. We use page parameter so we can get notifications from different pages.
        function loadNotifications() {
            $.ajax({
                type: 'GET',
                url: `selfevaluation/getReadNotifications?page=${page}`,
                data: {
                    filter: $("#NotificationsFilter").val(),
                    perPage: perPage
                },
                success: function (data) {
                    if(perPage == "all") {
                        data = data.notifications
                        moreNotifications = false;

                    } else {
                        data = data.notifications.data
                    }

                     //If more notifications is false we empty the notifications div. Otherwise we will append the received messages
                     //at the end of the already generated messages.
                     //We empty our NoNotifications div in case we get messages from this request.
                     if(!moreNotifications) {
                         $('#notifications').empty();
                     }
                     $('#NoNotifications').empty();

                     //Check if data received contains any messages. if not we will add text to our NoNotifications div
                     //Check if moreNotifications was true, depending on this we change the message.
                     //We also hide the moreNotification button since our last request didn't give us any new messages.
                     if (data.length === 0) {
                         if(!moreNotifications){
                             $('#NoNotifications').append(`Er zijn geen meldingen gevonden.`)
                         } else {
                             $('#NoNotifications').append(`Er zijn geen extra meldingen meer gevonden.`)
                         }
                         $('#moreNotifications').hide()

                     } else {
                         //If we queried for all, we don't want to show more notifications button
                         if(perPage == "all") {
                             $('#moreNotifications').hide()
                         } else {
                             $('#moreNotifications').show()
                         }
                         //If we got here we have notifications. Depending on our filter we show the received notifications differently.
                         $.each(data, function (index, value) {
                             let html = "";
                             let date = new Date(value["created_at"])
                             if ($("#NotificationsFilter").val() == 1) {
                                 html = `
                                         <div class="alert alert-success shadow" role="alert" name="">
                                             [${date.toLocaleString('fr-BE')}] Student ${value.data["user"]} heeft een reflectieverslag ingediend:
                                             <a class="btn btn-primary" href="selfevaluation/${value.data.studentAcademyYear["id"]}/download">
                                                 <i class="fa fa-download" aria-hidden="true"></i> Download ${value.data.studentAcademyYear["self_evaluation_file"]}
                                             </a>
                                             <a href="#" class="close markAsRead" data-toggle="tooltip" title="Markeer als gelezen." data-id="${value["id"]}">
                                             <i class="fas fa-times text-danger"></i></a>
                                         </div>`
                             } else {
                                 html = `
                                         <div class="alert alert-info shadow" role="alert" name="">
                                             [${date.toLocaleString('fr-BE')}] Student ${value.data["user"]} heeft een reflectieverslag ingediend:
                                             <a class="btn btn-primary" href="selfevaluation/${value.data.studentAcademyYear["id"]}/download">
                                                 <i class="fa fa-download" aria-hidden="true"></i> Download ${value.data.studentAcademyYear["self_evaluation_file"]}
                                             </a>
                                          </div>`
                             }
                             $('#notifications').append(html)
                         });
                     }
                    moreNotifications = false;

                }
            })
        }

        //session timeout
        function timeOutFunction(){
            setTimeout(function() {
                $('#sessionMessage').fadeOut('slow');
            }, 3000);
        }

    </script>
@endsection

