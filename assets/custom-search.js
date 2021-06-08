jQuery ( function( $ ) {

    function toggleBg(elt) {
        if ($(elt).css('background-color') == "rgba(0, 0, 0, 0)") {
            $(elt).css('background-color', "rgba(110, 193, 228, 0.5");
        } else {
            $(elt).css('background-color', "rgba(0, 0, 0, 0)");
        }
    }

    $('input.dot').change(function(){

        // the parent
        let directParent= this.parentElement;

        // active background
        toggleBg(directParent);

        // toggle sous cat
        if ($(directParent).hasClass('form-cat-parent')) {
            let myClass = directParent.firstElementChild.value;
            let myTarget = 'div.form-cat-right.' + myClass;
            $(myTarget).toggle();   
        }
    });

});