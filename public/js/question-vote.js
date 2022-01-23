// Js to handle the comments vote
const container = $(".js-vote-arrows");
container.find("a").on("click", (e) => {
  e.preventDefault();
  const link = $(e.currentTarget);
  $.ajax({
    type: "POST",
    url: `/api/comment-vote/${link.data("direction")}/987azerty`,
    //   data: "data",
    //   dataType: "dataType",
  }).then(function (res) {
    container.find(".js-vote-total").text(res.votes);
  });
});
