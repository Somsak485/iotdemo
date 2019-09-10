<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <button id="btn">Show Chart</button>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $( document ).ready(function(){
        $("#btn").click(function(){

            var dataPoints_f1=[];
            var dataPoints_f2=[];
            var url ="https://api.thingspeak.com/channels/860699/feeds.json?results=50";

            $.ajax(
                    {

                      url: url, 
                      type: 'get', 
                      dataType: 'json',
                      success: function(feedback){
                            //alert(JSON.stringify(feedback.feeds));
                            
                            $.each(feedback.feeds,function(k,item){
                                //alert(JSON.stringify(item.field1)); 
                                dataPoints_f1.push({
                                    y:parseInt(item.field1)
                                });
                                dataPoints_f2.push({
                                    y:parseInt(item.field2)
                                });  
                               

                            });
                            //alert(JSON.stringify(dataPoints_f1));      
                                                                          
                            var chart = new CanvasJS.Chart("chartContainer", {
                              animationEnabled: true,
                              theme: "light1",
                              title:{
                                text: "Simple Line Chart"
                              },
                              axisY:{
                                includeZero: false
                              },
                              data: [
                                      {        
                                        type: "line",       
                                        dataPoints:dataPoints_f1  
                                      },
                                  
                                      {        
                                        type: "line",       
                                        dataPoints: dataPoints_f2
                                      }
                                   
                                  ]
                            });
             
                            chart.render();  

                          
                      } 

          });

        });
      });
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </body>
</html>
