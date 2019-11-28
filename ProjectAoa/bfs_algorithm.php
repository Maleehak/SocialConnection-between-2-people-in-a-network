<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>
                Network Connection
            </title>
            <link href="images/titleLogo.jpg" rel="icon" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="style/style.css?version=51" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="p5.js"></script>
    <?php 
    if(isset($_SESSION['name'])){
        $n=$_SESSION['name'];
    }
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
    }

//$data=array();
$servername = "localhost";
$username = "root";
$password = "";
$dbname="socialnetwork";
//create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    //took user ids' from database
    $sql ="SELECT id,name from users";
    $result = mysqli_query($conn, $sql);  
    $rows = [];
   //converted mysql query to array
   while($row = mysqli_fetch_array($result)){
       array_push($rows,$row);
   }
   //converted PHP array to JS array
    $json = json_encode($rows);
    //$data=$json;
}?> 

</head>
    <body> 
                <nav class="navbar navbar-expand-md sticky-top navbar-dark" id="customColor" >
                    <!--Title of the page in navbar-->
                    <div class="navbar-brand" id="textColor">
                        
                       <h5 class="h5">
                            <img src="images/logo.jpg" width="25vh">
                        Connection Between Two People in a Network
                       </h5> 
                    </div>
                </nav>
                <div  id="userOption">
                <div class="container" >
                <form class="form-inline" method="POST">
                    <br>
                <div class="row" id="userOptionRow">
                    <div class="col-3" >
                    <h4 class="text-center">Enter User Name to Search:</h4>
                    </div>
                    <div class="col-3">
                    <div class="input-container">
                                <i class="fa fa-user icon"></i>
                             <input type="text"  name="username" placeholder="<?php echo $n?>" class="input-field"  disabled style="background-color:white" >
                           
                        </div>
                    </div>
                    <div class="col-3" >
                    <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input type="text" name="username2" placeholder="Enter User Name" class="input-field" required >
                           
                        </div>
                    </div>
                    <div class="col-3">
                    <div>
                        <button type="submit" class="btn btn-default"  name="submit"><span style="color:white;"><h5>Search</span></h5></button>
                         </div>
                    </div>
                    </form>
                </div>
                <div>
    <script >
        var user1="<?php echo $n?>"; //for string
        var user1Id=<?php echo $id?>;
        console.log(user1);
        console.log(user1Id);
        function setup(){
        createCanvas(windowWidth,windowHeight);
        background('white');
        createGraph();
    }
    function createGraph(){
        //took data from PHP  
        var vertices = <?= $json?>;
        var length = vertices.length;   
    //classes
        //Graph from DB    
        class Graph { 
            constructor(nodes) { 
                this.nodes = nodes; 
                this.adjacencyList = new Map(); 
            } 
          
            addVertices(vertex,x,y) {
            console.log(vertex);
            this.adjacencyList.set(vertex.id, new Set());
            stroke('#475770');
             fill('#475770');
            ellipse(x, y, 50, 50);
            fill('white');
            textAlign(CENTER);
            text(vertex.name, x,y);

                } 
            addEdges(vertex1, vertex2) { 
            var user1=vertex1.id;
            var user2=vertex2.id; 
            this.adjacencyList.get(user1).add(user2);
            this.adjacencyList.get(user2).add(user1);  
                } 

            printGraph() { 
            var keys = this.adjacencyList.keys();    
            for (var i of keys)  { 
                var adjacentNodes = this.adjacencyList.get(i); 
                var concate = ""; 
                for (var nodes of adjacentNodes) {
                   var userId=nodes;
                    concate += userId + " ";
                 }
                 console.log(i + " -> " + concate);
            }
            }
            getSuccessors(vertex){
                return this.adjacencyList.get(vertex);
            }
          
        }

    //Queue to be used in BFS
    class Queue{
         constructor(){
            this.queue=[]
        }
        enqueue(value) {
             this.queue.push(value);
            }
        dequeue(){
            if(!this.isEmpty()){
                return this.queue.shift();//remove from start of array
            }  
        }
        isEmpty(){
            if(this.queue.length==0){
                return 0;
            }
        }
        print(){
            for (var i=0;i<this.queue.length;i++ )
             console.log(i);
            }
        }
        
        //functions
        function randomNumber(min,max){
            return parseInt(Math.random()*(max-min)+min);
        }

        function createRandomEdge(g,length){
            var g = new Graph(length); 
            var neighbor;
            var mapVertices=new Map();

            //add vertices
            //debugger;
            for (var i = 0; i < length; i++) { 
                //debugger;
                var x=randomNumber(50,windowWidth-50);
                var y=randomNumber(50,windowHeight-50);
                g.addVertices(vertices[i],x,y); 
                mapVertices.set(vertices[i].id,[x,y]);
                console.log(mapVertices);
            }
            //add edges
            for (var i = 0; i <length; i++) { 
                //how many edges for each vertex
                var randomEdges=randomNumber(0,length-1);
                console.log(randomEdges);
                //which node to connect
                for(var j=0; j<=randomEdges;j++){
                    var randomIndex=randomNumber(0,length-1);
                    neighbor=vertices[randomIndex]
                    if(randomIndex!=i){
                        var node1=vertices[i];
                        var node2=neighbor;
                       g.addEdges(node1,node2);
                      var x1=mapVertices.get(node1.id)[0];
                       var y1=mapVertices.get(node1.id)[1];
                       var x2=mapVertices.get(node2.id)[0];
                       var y2=mapVertices.get(node2.id)[1];
                        
                       line(x1,y1,x2,y2);
                    }    
                    }   
                }
                g.printGraph();
               return g;
            } 

        //BFS
        function BFS(g,s,e){
            var key=true;
            var mapPath=new Map();
            var end = e.toString();
            var start = s.toString();
            console.log("START NODE is "+ s);
            console.log("END NODE is "+ e);
            for(i=0;i<vertices.length;i++){
                //var endNode=e.toString();
                if(end==vertices[i].id){
                    key=true;
                    break;
                }
                else{
                    key=false;
                }
            }
            if(key==false){
                console.log("user not found");
            }
           var queue = new Queue();
           var explored = [];
           //var startNode=s.toString();
           explored.push(start);
           queue.enqueue(start);
           while(!queue.isEmpty()){
               var parentNode = queue.dequeue();
               if(parentNode==end){
                   break;
               }
               var allSuccessors = g.adjacencyList;
               var temp=parentNode.toString();
               var successors=allSuccessors.get(temp);
                for (var successor of successors){
                  if(explored.includes(successor)==false){
                     mapPath.set(successor,parentNode);
                     console.log(mapPath);
                    explored.push(successor);
                    queue.enqueue(successor);
                    }
               }
            }
            var path=[];
            path.push(end);
           while(end!=start){
            var next=mapPath.get(end);
            path.push(next);
            end=next;
           }
            path=path.reverse();
            return path;
        }
            //for console output
            //debugger;
            var g = new Graph(length);
            var e=createRandomEdge(g,length);
            var randomNumber1 = randomNumber(1,length-1);
            var randomNumber2 = randomNumber(1,length-1);
            //debugger;
          var path = BFS(e,randomNumber1,randomNumber2);
        var path = path.toString();
           console.log("PATH  "+ "("+ path + ")");
    }
     //session destroy
        </script>
     
    </body>
</html>
