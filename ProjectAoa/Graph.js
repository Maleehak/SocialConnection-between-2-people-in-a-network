
        class Graph { 
            constructor(nodes) 
            { 
                this.nodes = nodes; 
                this.adjacencyList = new Map(); 
            } 
          
            addVertices(vertex) 
        { 
            this.adjacencyList.set(vertex, []); 
        } 
        
        addEdges(vertex1, vertex2) 
        { 
            this.adjacencyList.get(vertex1).push(vertex2); 
            this.adjacencyList.get(vertex2).push(vertex1); 
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
        var g = new Graph(6); 
        var vertices = [ 1, 2, 3, 4 ]; 
          
        for (var i = 0; i < vertices.length; i++) { 
            g.addVertices(vertices[i]); 
        } 
         
        g.addEdges(1, 2); 
        g.addEdges(3, 2); 
        g.addEdges(4, 1); 
        g.addEdges(2, 4); 
        g.addEdges(1, 3);
        g.printGraph();