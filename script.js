function searchFunction(searchId, completeUrl) {
    $(document).ready(function () {
      // Send Search Text to the server
      $(searchId).keyup(function () {
        let searchText = $(this).val();
        if (searchText != "") {
          $.ajax({
            url: completeUrl,
            method: "post",
            data: {
              query: searchText,
            },
            success: function (response) {
              $("#show-list").html(response);
            },
          });
        } else {
          $("#show-list").html("");
        }
      });
      // Set searched text in input field on click of search button
      $(document).on("click", "a", function () {
        $(searchId).val($(this).text());
        $("#show-list").html("");
      });
    });
  }

  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  