//Selects specified elements and store into array using CSS selectors

const img_lists = document.querySelectorAll(".container .images img");

const text_items = document.querySelectorAll(".container-content");

const buttons = document.querySelectorAll(".container-text .buttons-choice button");

let index = 1;


//Checks if 'Previous' button has been clicked on
document.getElementById("previous").addEventListener("click", function(){
  
  if (index > 1){
    index -= 1;
    console.log(index);
    var temp = index;

    //Checks every elements in img_lists and executes the function(img)
    img_lists.forEach(
      function(img){

        var img_class = img.getAttribute("class");
        var temp = "img-" + index;

        //Checks if 'index' and '"img-" + index' is the same
        if(img_class == temp){
          img.style.display = "block";
        }
        else{
          img.style.display = "none";
        }
      }
    )
            
    //Checks every elements in text_items and executes the function(item)
    text_items.forEach(
      function(item){    

        var text_class = item.getAttribute("class");
        var temp = "container-content container-" + index;

        //Checks if 'class' matches with 'data-tc'
        if(text_class == temp){
          item.style.display = "block";
        }
        else{
          item.style.display = "none";
        }
      }
    )

    document.getElementById("index").innerHTML = temp + "/3";

  }

})

//Checks if 'Next' button has been clicked on
document.getElementById("next").addEventListener("click",function(){
  
  if (index < 3){
    index += 1;
    console.log(index);
    var temp = index;

    //Checks every elements in img_lists and executes the function(img)
    img_lists.forEach(
      function(img){

        var img_class = img.getAttribute("class");
        var temp = "img-" + index;

        //Checks if 'index' and '"img-" + index' is the same
        if(img_class == temp){
          img.style.display = "block";
        }
        else{
          img.style.display = "none";
        }
      }
    )
            
    //Checks every elements in text_items and executes the function(item)
    text_items.forEach(
      function(item){    

        var text_class = item.getAttribute("class");
        var temp = "container-content container-" + index;

        //Checks if 'class' matches with 'data-tc'
        if(text_class == temp){
          item.style.display = "block";
        }
        else{
          item.style.display = "none";
        }
      }
    )

    document.getElementById("index").innerHTML = temp + "/3";

  }

})
