
d3.csv("https://raw.githubusercontent.com/daveywb/electionmap/master/election-hex-pb.csv", function(data){
   // console.log(data)

		// Set the size and margins of the svg
		var margin = {top: 10, right: 10, bottom: 10, left: 10},
			width = 770 - margin.left - margin.right,
			height = 983 - margin.top - margin.bottom;

		// Create the svg and attach to #map
			var svg = d3
				.select("#map")
				.append("svg")
				.attr("width", width + margin.left + margin.right)
				.attr("height", height + margin.top + margin.bottom)
				.append("g")
				.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		// Create the positions of the circles		
			var electionmap = svg
				.selectAll("g")
				.data(data)
				.enter()
				.append("g")
				.attr("transform", function(d) {
					//the position of each circle
						return "translate(" + (400 + d.q2*24) + "," + (983 - (390 + d.r2*21)) + ")";
					});

					// Define the div for the tooltip
				var div = d3.select("body")
					.append("div")
				  .attr("class", "tooltip")
				  .style("opacity", 0);

					// Draw the circles and colour
				electionmap
			      .append("circle")
			      .attr("cx", 9)
						.attr("cy", 9)
						.attr("r", 9)
			      .attr("stroke", function(d) {
                         var returnColor;
                         		if (d.Winner15 == "Con") { returnColor = "#6487d5";
											} else if (d.Winner15 == "Lab") { returnColor = "#dc5971";
										 	} else if (d.Winner15 == "LD") { returnColor = "#f1b359";
									 		} else if (d.Winner15 == "SNP") { returnColor = "#eff55f";
								 			} else if (d.Winner15 == "Green") { returnColor = "#9dcc6f";
							 				} else if (d.Winner15 == "PC") { returnColor = "#599c90";
						 					} else if (d.Winner15 == "DUP") { returnColor = "#637a9b";
					 						} else if (d.Winner15 == "SF") { returnColor = "#789771";
				 							} else if (d.Winner15 == "Other") { returnColor = "#9c9c9c";
			 								} else if (d.Winner15 == "UKIP") { returnColor = "#65cddc"; }
                         return returnColor;
                      })
			      .attr("stroke-width", "5")
			      .attr("fill", function(d) {
                         var returnColor;
                         if (d.Winner17 == "Con") {
													  if (d.Winner15 == "Con") {
													 returnColor = "#6487d5";
												 }else{
													 returnColor = "#1146bf";
												 }
											 } else if (d.Winner17 == "Lab") {
												 if (d.Winner15 == "Lab") {
												 returnColor = "#dc5971";
											 }else{
												 returnColor = "#c90025";
											 }
										 } else if (d.Winner17 == "LD") {
											 if (d.Winner15 == "LD") {
											 returnColor = "#f1b359";
										 }else{
											 returnColor = "#ea8a00";
										 }
									 } else if (d.Winner17 == "SNP") {
										 if (d.Winner15 == "SNP") {
										 returnColor = "#eff55f";
									 }else{
										 returnColor = "#e7f000";
									 }
								 } else if (d.Winner17 == "Green") {
									 if (d.Winner15 == "Green") {
									 returnColor = "#9dcc6f";
								 }else{
									 returnColor = "#69b022";
								 }
							 } else if (d.Winner17 == "PC") {
								 if (d.Winner15 == "PC") {
								 returnColor = "#599c90";
							 }else{
								 returnColor = "#006755";
							 }
						 } else if (d.Winner17 == "DUP") {
							 if (d.Winner15 == "DUP") {
							 returnColor = "#637a9b";
						 }else{
							 returnColor = "#0f3366";
						 }
					 } else if (d.Winner17 == "SF") {
						 if (d.Winner15 == "SF") {
						 returnColor = "#789771";
					 }else{
						 returnColor = "#306025 ";
					 }
				 } else if (d.Winner17 == "Other") {
					 if (d.Winner15 == "Other") {
					 returnColor = "#9c9c9c";
				 }else{
					 returnColor = "#676767";
				 }
			 } else if (d.Winner17 == "UKIP") {
				 if (d.Winner15 == "UKIP") {
				 returnColor = "#65cddc";
			 }else{
				 returnColor = "#12b2ca";
			 }

			 }
										return returnColor;
                      })
						//Tooltips					
						.on("mouseover", function(d) {

							var tooltipString = '';
							if (d.Winner17 == d.Winner15){
								tooltipString = '<strong>' + d.n + '</strong><br />' + d.Winner17 + ' hold';
							}else{
								tooltipString = '<strong>' + d.n + '</strong><br />' + d.Winner17 + ' gain from ' + d.Winner15;
							}

            div.transition()
                .duration(200)
                .style("opacity", 0.9);
            div.html(tooltipString)
                .style("left", (d3.event.pageX) + "px")
                .style("top", (d3.event.pageY - 28) + "px");
            })
        .on("mouseout", function(d) {
            div.transition()
                .duration(500)
                .style("opacity", 0);
        });


});
