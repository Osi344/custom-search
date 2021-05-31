$(document).ready(function() {

    function toggleBg(elt) {
        let test= $(elt).css('background-color');
        console.log("element bg color: ", test);
        if ($(elt).css('background-color') == "rgba(0, 0, 0, 0)") {
            $(elt).css('background-color', "rgba(110, 193, 228, 0.5");
        }
        else {
            $(elt).css('background-color', "rgba(0, 0, 0, 0)");
        }
    }

    // let list = document.querySelectorAll('.form-cat-parent');
    let list = document.querySelectorAll('.form-cat-element');

    for (let element of list) {

        console.log('element: ', element);

        element.addEventListener('click', function(ev) {

            // display child cat
            if ($(element).hasClass('form-cat-parent')) {
                let myClass = element.firstElementChild.value;
                let myTarget = 'div.form-cat-right.' + myClass;
                $(myTarget).toggle();

                toggleBg(element);
            }

            // checkbox toggle state
            let elementCheckbox = element.firstElementChild;
            if (elementCheckbox.checked === true) {
                elementCheckbox.checked = false;
            } else {
                elementCheckbox.checked = true;
            }

            // decocher toutes les sous cat qd cat decochée
        }, false);
    }

});