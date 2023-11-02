//Selects specified elements and store into array using CSS selectors
const tab_lists = document.querySelectorAll(".TOC ol li");
const tab_items = document.querySelectorAll(".tab_item"); 

//Calls function(list) for each element in tab_lists
tab_lists.forEach(
  function(list){

    //Checks if the user clicks on any of the elements in tab_lists and executes the function once that occurs
    list.addEventListener("click", function()
      {

        //Gets the value of the 'data-tc' attribute for each element in tab_lists
        var tab_data = list.getAttribute("data-tc");

        //Removes the 'active' class from all elements in the tab_lists
        tab_lists.forEach(
          function(list){
            list.classList.remove("active");
          }
        );
        
        //Adds the 'active' class on the clicked element
        list.classList.add("active");
        
        //Checks every elements in tab_items and executes the function(item)
        tab_items.forEach(
          function(item){
            
            //Gets the value in 'class' and store them into an array (done with .split(" "))
            var tab_class = item.getAttribute("class").split(" ");

            //Checks if 'class' matches with 'data-tc'
            if(tab_class.includes(tab_data)){
              item.style.display = "block";
            }
            else{
              item.style.display = "none";
            }
          }
        )
      }
    )
  }
)