 class Graph { 
            constructor(nodes) 
            { 
                this.nodes = nodes; 
                this.adjacencyList = new Map(); 
            } 
          
            addVertices(vertex) 
        { 
            this.adjacencyList.set(vertex,new Set()); 
        } 
        
        addEdges(vertex1, vertex2) 
        { 
            this.adjacencyList.get(vertex1).add(vertex2); 
            this.adjacencyList.get(vertex2).add(vertex1); 
        } 
        printGraph() 
        { 
            var keys = this.adjacencyList.keys(); 
         
            for (var i of keys)  
        { 
                var adjacentNodes = this.adjacencyList.get(i); 
                var concate = ""; 
                for (var nodes of adjacentNodes) 
                    concate += nodes + " "; 
                console.log(i + " -> " + concate); 
            } 
        }
        } 
        function randomNumber(min,max){
            return parseInt(Math.random()*(max-min)+min);
        }

        function createRandomEdge(){
            var g = new Graph(6); 
            var vertices = [ 'A', 'B', 'C', 'D', 'E', 'F' ];
            var nodesList=[];
            var neighbor;
            //add vertices
            for (var i = 0; i < vertices.length; i++) { 
                g.addVertices(vertices[i]); 
            }
            //add edges
            for (var i = 0; i < vertices.length; i++) { 
                //how many edges for each vertex
                var randomEdges=randomNumber(0,vertices.length-1);
                //which node to connect
                for(var j=0; j<=randomEdges;j++){
                    var randomIndex=randomNumber(0,vertices.length-1);
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
            
        createRandomEdge();
        