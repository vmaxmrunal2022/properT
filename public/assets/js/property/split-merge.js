/*
   File: split-merge.js
   Description: This JavaScript file contains the code for manipulating and merging property GIS IDs.
   Author: 
   Date: July 5, 2023
   
   -- Instructions --
   1. Splitting Property GIS IDs:
      - Use the splitGISID() function to break down a single GIS ID into its constituent parts.

   2. Merging Property GIS IDs:
      - Use the mergeGISID() function to combine separate components into a single GIS ID.
*/

// JavaScript code starts here...

    let splitMergeElement   = $('.split-merge-gis');
    let GISIDContainer      = $('.append-gisid');
    let splitMergeContainer = $('.split-merge-container');
    let addGISIDButton      = $('.add-gis-id');
    
    let splitGISIDElement   =   `<div class="col-xxl-3 col-md-3 mt-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Split Property </label>
                                        <select class="form-select ctfd-required" name="split_property" id="split-property">
                                            <option value="" selected disabled>-Select -</option>
                                            <option value="1" >split by 1</option>
                                            <option value="2" >split by 2</option>
                                            <option value="3" >split by 3</option>
                                        </select>
                                    </div>
                                </div>`;

    let mergeGISIDElement   =   `<div class="col-xxl-12 col-md-12  mt-3">
                                
                                </div>
                                <div class="col-xxl-3 col-md-3 append-gisid">
                                    <div class="form-group ">
                                        <label for="" class="form-label">Merge GISID </label>
                                        <div class="input-group mb-1">
                                            <input type="text" name="mgis_id[]" class="form-control ctfd-required mgis-id" id="" placeholder="" value="" >
                                            <span class="input-group-text p-0 bg-primary">
                                                <button class="add-gis-id btn btn-primary" type="button">Add GISID</button>
                                            </span>
                                            </div>
                                        </div>
                                </div>`;

    let GISIDElement        =   `<div class="col-xxl-3 col-md-3 append-gisid">
                                    <div class="form-group ">
                                        <div class="input-group mb-1">
                                            <input type="text" name="mgis_id[]" class="form-control ctfd-required mgis-id" >
                                            <span class="mdi mdi-delete-outline input-group-text mdi-24px py-0  btn btn-danger remove-GISID"></span>
                                            </div>
                                    </div>
                                </div>`;               
    splitMergeElement.on('dblclick', function(){
        let checkStatus     = $(this).prop('checked');
        // if(checkStatus === true){
            $(this).prop('checked', false);
            splitMergeContainer.html('');
        // }
            
    });

    splitMergeElement.on('click', function(){
        let checkStatus     = $(this).prop('checked');
        let selectedOption  = $(this).attr('id');
        selectedOption      = selectedOption.toLowerCase();
        (checkStatus === true && selectedOption == 'split-gis') ? splitGISID() :'';
        (checkStatus === true && selectedOption == 'merge-gis') ? mergeGISID() :'';
    });

    $(document).on('click', '.add-gis-id',function(){
        addGISID();
    });

    $(document).on('click', '.remove-GISID',function(){
       $(this).parent().closest('.append-gisid').remove();
    });

    function splitGISID(){
        splitMergeContainer.html(splitGISIDElement);
    }

    function mergeGISID(){
        splitMergeContainer.html(mergeGISIDElement);
    }

    function addGISID(){
        let mergeIDs = $('.append-gisid').length;
        if(mergeIDs <= 4)
            $('.append-gisid').last().after(GISIDElement);
    }

// JavaScript code ends here...