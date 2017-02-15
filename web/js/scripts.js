function setBoard(game) {
    $('div').removeClass('black-king black-queen black-bishop black-knight black-rook white-king white-queen white-bishop white-knight white-rook active-piece');
    $('#row'+game.blackKing.yCoord+' #col'+game.blackKing.xCoord).addClass('black-king');
    $('#row'+game.blackQueen.yCoord+' #col'+game.blackQueen.xCoord).addClass('black-queen');
    $('#row'+game.blackBishop1.yCoord+' #col'+game.blackBishop1.xCoord).addClass('black-bishop');
    $('#row'+game.blackBishop2.yCoord+' #col'+game.blackBishop2.xCoord).addClass('black-bishop');
    $('#row'+game.blackKnight1.yCoord+' #col'+game.blackKnight1.xCoord).addClass('black-knight');
    $('#row'+game.blackKnight2.yCoord+' #col'+game.blackKnight2.xCoord).addClass('black-knight');
    $('#row'+game.blackRook1.yCoord+' #col'+game.blackRook1.xCoord).addClass('black-rook');
    $('#row'+game.blackRook2.yCoord+' #col'+game.blackRook2.xCoord).addClass('black-rook');
    $('#row'+game.whiteKing.yCoord+' #col'+game.whiteKing.xCoord).addClass('white-king');
    $('#row'+game.whiteQueen.yCoord+' #col'+game.whiteQueen.xCoord).addClass('white-queen');
    $('#row'+game.whiteBishop1.yCoord+' #col'+game.whiteBishop1.xCoord).addClass('white-bishop');
    $('#row'+game.whiteBishop2.yCoord+' #col'+game.whiteBishop2.xCoord).addClass('white-bishop');
    $('#row'+game.whiteKnight1.yCoord+' #col'+game.whiteKnight1.xCoord).addClass('white-knight');
    $('#row'+game.whiteKnight2.yCoord+' #col'+game.whiteKnight2.xCoord).addClass('white-knight');
    $('#row'+game.whiteRook1.yCoord+' #col'+game.whiteRook1.xCoord).addClass('white-rook');
    $('#row'+game.whiteRook2.yCoord+' #col'+game.whiteRook2.xCoord).addClass('white-rook');
    for (var pieces in game) {
        if (game[pieces].active) {
            $('#row'+game[pieces].yCoord+' #col'+game[pieces].xCoord).addClass('active-piece');

        }
    }
}




$(function() {
    var subject = "";
    var pieceLoc;
    var currentType;
    $(".row div").click(function() {
        var xIndex = parseInt(removeLetters($(this).attr("id")));
        var yIndex = parseInt(removeLetters($(this).parent().attr("id")));
            $.post("/move", {xIndex: xIndex, yIndex: yIndex}, function(response) {
              console.log(response);
              game = JSON.parse(response);
              setBoard(game);
            });
        });

    function removeLetters(index) {
        return index.slice(-1);
    }
});
