<script  type="text/javascript" src="assets/js/go-debug.js" ></script>


<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    
    <div class="container">
       <?php 
        //echo getImagePath($this->images_path . $result_0['p_personid'] . '/' . $result_0['p_faceimage'])."</br>";
        //print_r($result_2);
       ?>
        <br/>
        <!--<div id="myDiagramDiv" style="width:1280px; height:950px; background-color: #969696;">--> 
        <div id="myDiagramDiv" style="width:1280px; height:950px; background-color: #fff;"> 
        </div>
    </div>
</div>

<script> 
    var $ = go.GraphObject.make;

    var myDiagram =
      $(go.Diagram, "myDiagramDiv",
        {
          initialContentAlignment: go.Spot.Center, // center Diagram contents
          "undoManager.isEnabled": true, // enable Ctrl-Z to undo and Ctrl-Y to redo
          layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                    { angle: 90, layerSpacing: 35 })
        });

    // the template we defined earlier
    myDiagram.nodeTemplate =
      $(go.Node, "Horizontal",
        { background: "#193750" },
        $(go.Picture,
          { margin: 10, width: 50, height: 50, background: "#193750" },
          new go.Binding("source")),
        $(go.TextBlock, "Default Text",
          { margin: 12, stroke: "white", font: "bold 16px sans-serif" },
          new go.Binding("text", "name"))
      );

    // define a Link template that routes orthogonally, with no arrowhead
    myDiagram.linkTemplate =
      $(go.Link,
        { routing: go.Link.Orthogonal, corner: 5 },
        $(go.Shape, { strokeWidth: 3, stroke: "#555" })); // the link shape

    var model = $(go.TreeModel);
    model.nodeDataArray =
    [
       <?php 
        if(isset($result_0['p_faceimage']) && $result_0['p_faceimage']){
            $pic = getImagePath($this->images_path . $result_0['p_personid'] . '/' . $result_0['p_faceimage']);
        }else{
            $pic = getImagePath($this->images_path ."Office-Customer.png");
        }
       ?>
    //Person
      { key: "<?= $result_0['p_personid'];?>",              name: "<?= $result_0['p_title']." ".$result_0['p_firstname']." ".$result_0['p_lastname'];?>",   source: "<?=$pic;?>" },
      <?php 
      if(isset($result_1) && $result_1){
          
      }else{
          $result_1 = array();
      }
        foreach($result_1 as $k_r1 => $v_r1){
            $np_paragraph = trim(cutCaption(stripHTMLTags($v_r1['np_paragraph']), 50));
            $np_paragraph = str_replace("\n", "", $np_paragraph);
            $np_paragraph = str_replace("<br/>", "", $np_paragraph);
            $np_paragraph = str_replace("<br", "", $np_paragraph);
            $np_paragraph = str_replace(" ", "", $np_paragraph);
            $np_paragraph = str_replace("&nbsp;", "", $np_paragraph);
            $np_paragraph = str_replace("&ndash;", "", $np_paragraph);
            $np_paragraph = str_replace("&n", "", $np_paragraph);
            
            
      ?>
      <?php 
        if(isset($v_r1['p_faceimage']) && $v_r1['p_faceimage']){
            $pic = getImagePath($this->images_path . $v_r1['p_personid'] . '/' . $v_r1['p_faceimage']);
        }else{
            $pic = getImagePath($this->images_path ."no-image.gif");
        }
       ?>
       //News       
       { key: "<?= $v_r1['np_paragraph_id'];?>",   parent: "<?=$result_0['p_personid'];?>",   name: "<?= $np_paragraph;?>",   source: "<?=$pic;?>" },    
      
      <?php 
        }
      ?>
      <?php  
      if(isset($result_2) && $result_2){
          
      }else{
          $result_2 = array();
      }
      foreach($result_2 as $k_r2 => $v_r2){
      
        if(isset($v_r2['p_faceimage']) && $v_r2['p_faceimage']){
            $pic = getImagePath($this->images_path . $v_r2['p_personid'] . '/' . $v_r2['p_faceimage']);
        }else{
            $pic = getImagePath($this->images_path ."Office-Customer.png");
        }
       ?>       
       //Person
       { key: "<?= $v_r2['p_personid'];?>",   parent: "<?=$v_r2['np_paragraph_id'];?>",   name: "<?= $v_r2['p_title']." ".$v_r2['p_firstname']." ".$v_r2['p_lastname'];?>",   source: "<?=$pic;?>" },    
      <?php 
        }
      ?>
              
      <?php  
      if(isset($result_3) && $result_3){
          
      }else{
          $result_3 = array();
      }
        foreach($result_3 as $k_r3 => $v_r3){
            $np_paragraph = trim(cutCaption(stripHTMLTags($v_r3['np_paragraph']), 50));
            $np_paragraph = str_replace("\n", "", $np_paragraph);
            $np_paragraph = str_replace("<br/>", "", $np_paragraph);
            $np_paragraph = str_replace("<br", "", $np_paragraph);
            $np_paragraph = str_replace(" ", "", $np_paragraph);
            $np_paragraph = str_replace("&nbsp;", "", $np_paragraph);
            $np_paragraph = str_replace("&ndash;", "", $np_paragraph);
            $np_paragraph = str_replace("&n", "", $np_paragraph);
            
        if(isset($v_r3['p_faceimage']) && $v_r3['p_faceimage']){
            $pic = getImagePath($this->images_path . $v_r3['p_personid'] . '/' . $v_r3['p_faceimage']);
        }else{
            $pic = getImagePath($this->images_path ."no-image.gif");
        }
      ?>
       //News       
       { key: "<?= $v_r3['np_paragraph_id'];?>",   parent: "<?=$v_r3['p_personid'];?>",   name: "<?= $np_paragraph?>",   source: "<?=$pic;?>" },    
      
     <?php 
             }
     ?>
              
              
      { key: "", name: "สามารถกด Ctr Zoom ได้" }
    ];
    myDiagram.model = model;
</script>




