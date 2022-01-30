var elemHearts = document.getElementsByClassName("frhd__post-block-wrap");
for (var i = 0; i < elemHearts.length; i++) {

    elemHearts[i].addEventListener('click', function() {

        elemSVG = this.querySelector(".frhd__user-react").children[0];
        if ( elemSVG.classList.contains("frhd__user-react-love") ) {

            elemSVG.classList.remove("frhd__user-react-love");
        } else {

            elemSVG.classList.add("frhd__user-react-love");
        }
    })
}


(function( $ ) {
	'use strict';

    function loadTakenSeats() {

        var takenSeatsString = sessionStorage.takenSeats;
        return takenSeatsString
            ? JSON.parse(takenSeatsString)
            : [];
    }

    function saveTakenSeats(takenSeats) {

        sessionStorage.takenSeats = JSON.stringify(takenSeats);
    }

    function takeSeat(seat) {

        var takenSeats = loadTakenSeats();
        takenSeats.push($(seat).attr('data-id'));
        saveTakenSeats(takenSeats);
    }

    function untakeSeat(seat) {

        var takenSeats = loadTakenSeats();
        takenSeats.pop($(seat).attr('data-id'));
        saveTakenSeats(takenSeats);
    }

    $(function(){

        // restore taken seats
        $.each(loadTakenSeats(), function(i, seat) {

            $('div[data-id="'+seat+'"] svg').addClass('frhd__user-react-love');
        });

        $('.frhd__user-react').on('click', function() {

            var seat = this;
            if (loadTakenSeats().indexOf($(seat).attr('data-id')) < 0) {

                // not taken
                takeSeat(seat);
            } else {

                untakeSeat(seat);
            }
        });
    });

})( jQuery );