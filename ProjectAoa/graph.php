 <!DOCTYPE html>
<html>
    <head>
    <?php
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
    $sql ="SELECT id from users";
    $result = mysqli_query($conn, $sql);  
    $rows = [];
   //converted mysql query to array
   while($row = mysqli_fetch_array($result)){
       array_push($rows,$row);
   }
   //converted PHP array to JS array
    $json = json_encode($rows);
}?> 

</head>
    <body> 
    <script>
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
          
            addVertices(vertex) { 
            this.adjacencyList.set(vertex.id, new Set()); 
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
                this.queue.shift();//remove from start of array
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

        function createRandomEdge(){
            var g = new Graph(length); 
            var nodesList=[];
            var neighbor;
            //add vertices
            for (var i = 0; i < length; i++) { 
                g.addVertices(vertices[i]); 
            }
            //add edges
            for (var i = 0; i <length; i++) { 
                //how many edges for each vertex
                var randomEdges=randomNumber(0,length-1);
                //which node to connect
                for(var j=0; j<=randomEdges;j++){
                    var randomIndex=randomNumber(0,length-1);
                    neighbor=vertices[randomIndex]
                    if(randomIndex!=i){
                        var node1=vertices[i];
                        var node2=neighbor;
                        g.addEdges(node1,node2)
                    }    
                    }   
                }
                g.printGraph();
            }  
            //for console output
            createRandomEdge();
        </script>
    </body>
</html>