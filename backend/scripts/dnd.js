$(() => {
   $arr = [];
   $newArr = [];
    $(".draggable").draggable();
    $(".droppable").droppable({
      drop: function(event, ui) {
        $draggableId = ui.draggable.attr("id");
        $droppableId = $(this).attr("id");
        $d = $droppableId+":"+$draggableId;
        $(this).addClass("ui-state-highlight");
        $arr = [...$arr, $d];
        $.each($arr, function(i, $string){
            if($.inArray($string, $newArr) == -1) $newArr.push($string);
        });
      },

    out: function(event, ui) {
        $draggableId = ui.draggable.attr("id");
        $droppableId = $(this).attr("id");
        $d = $droppableId+":"+$draggableId;
        $(this).removeClass("ui-state-highlight");
        for($i = 0; $i < $newArr.length; $i++) {
            if($newArr[$i] == $d){
                 $newArr.splice($i, 1);
            }
        }
        for($i = 0; $i < $arr.length; $i++) {
            if($arr[$i] == $d) $arr.splice($i, 1);
        }
    }
  });
});