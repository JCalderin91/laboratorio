$('#disable').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let modal = $(this);
    modal.find('.modal-body #id').val(id);
});

$('#enable').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let modal = $(this);
    modal.find('.modal-body #id').val(id);
});

$('#hour').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('user_id');
    let op = button.data('operation');
    let modal = $(this);
    modal.find('.modal-body #user_id').val(id);
    modal.find('.modal-body #user_id').val(id);
    modal.find('.modal-body #operation').val(op);
});


window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(1000, function(){
      $(this).remove();
  });
}, 8000);



// autocomplete field



function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                //getUser(this.getElementsByTagName("input")[0].value);
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }

// Bloquear
// $('#ci').attr('disabled','disabled')

// Desbloquear
// $('#ci').removeAttr('disabled')
 $('#search').click(function(ev){
    ev.preventDefault();
    getUser($('#ci')[0].value);
 })
  
function getUser(user){
  axios.get('/clients/'+user)
  .then(function (response) {
    // handle success
    let user = response.data; 

      $('#first_name')[0].value = user.first_name;
      $('#first_name').parent().addClass('focused');
      $('#first_name').attr('disabled','disabled')

      $('#last_name')[0].value = user.last_name;
      $('#last_name').parent().addClass('focused');
      $('#last_name').attr('disabled','disabled')

      $('#area_name')[0].value = user.area;
      $('#area_name').parent().addClass('focused');
      $('#area_name').attr('disabled','disabled')

      $('#address')[0].value = user.address;
      $('#address').parent().addClass('focused');
      $('#address').attr('disabled','disabled')

      $('#phone')[0].value = user.phone;
      $('#phone').parent().addClass('focused');
      $('#phone').attr('disabled','disabled')    
  })
  .catch(function (error) {
      clear($('#first_name'));
      clear($('#last_name'));
      clear($('#area_name'));
      clear($('#address'));
      clear($('#phone'));

      $('#first_name').removeAttr('disabled')
      $('#last_name').removeAttr('disabled')
      $('#area_name').removeAttr('disabled')
      $('#address').removeAttr('disabled')
      $('#phone').removeAttr('disabled')
  })
  .then(function () {
    // always executed
  });
}

function clear(item){
    item[0].value = '';
    item.removeAttr('disabled');
    item.parent().removeClass('focused');
}