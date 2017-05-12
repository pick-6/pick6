
<div id="data-feed">

<script src="https:code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous">

$.ajax
({
  type: "GET",
  url: https://www.mysportsfeeds.com/api/feed/pull/nfl/2017-regular/scoreboard.json?fordate=20171112,
  dataType: "json",
  async: false,
  headers: {
    "Authorization": "Basic " + btoa({pick6} + ":" + {aubrey85})
  },
  data: "{ "Scores" }",
  success: function (){
    alert("Thanks for your comment!"); 
  }

  .done(function(data) {
    console.log(data);
  })
});

</script>

</div>