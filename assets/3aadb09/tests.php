<?php

        $url = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.multiSelectBootstrap.views'), false, -1, YII_DEBUG);

        Yii::app()->clientScript->registerCssFile($url . '/css/bootstrap-3.0.3.min.css');
        Yii::app()->clientScript->registerCssFile($url . '/css/bootstrap-multiselect.css');
        Yii::app()->clientScript->registerCssFile($url . '/css/prettify.css');
        
        Yii::app()->clientScript->registerScriptFile($url . '/js/bootstrap-3.0.3.min.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerScriptFile($url . '/js/bootstrap-multiselect.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($url . '/js/jquery-2.0.3.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile($url . '/js/prettify.js', CClientScript::POS_HEAD);

?>
        <a href="https://github.com/davidstutz/bootstrap-multiselect"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
        <div class="container">
            <div class="page-header">
                <h1>Bootstrap Multiselect Tests</h1>
            </div>
            
            <table class="table table-striped table-hover">
                <tbody>
                    <tr id="test-build-tr" class="success">
                        <th>Test build</th>
                        <td>
                            <select id="test-build-select" multiple="multiple">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-build-optgroups-tr" class="success">
                        <th>Test build with optgroups</th>
                        <td>
                            <select id="test-build-optgroups-select" multiple="multiple">
                                <optgroup label="1,2">
                                    <option value="1" selected="selected">1</option>
                                    <option value="2">2</option>
                                </optgroup>
                                <optgroup label="3,4,5">
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-build-selected-tr" class="success">
                        <th>Test build with selected options</th>
                        <td>
                            <select id="test-build-selected-select" multiple="multiple">
                                <option value="1" selected="selected">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-build-select-all-tr" class="success">
                        <th>Test build with select all</th>
                        <td>
                            <select id="test-build-select-all-select" multiple="multiple">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-build-filter-tr" class="success">
                        <th>Test build with filter</th>
                        <td>
                            <select id="test-build-filter-select" multiple="multiple">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-select-tr" class="success">
                        <th>Test select</th>
                        <td>
                            <select id="test-select-select" multiple="multiple">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-deselect-tr" class="success">
                        <th>Test deselect</th>
                        <td>
                            <select id="test-deselect-select" multiple="multiple">
                                <option value="1" selected="selected">1</option>
                                <option value="2" selected="selected">2</option>
                                <option value="3" selected="selected">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                    <tr id="test-max-height-tr" class="success">
                        <th>Test max height</th>
                        <td>
                            <select id="test-max-height-select" multiple="multiple">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                            </select>
                        </td>
                        <td>Everything fine.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                
                // Test build of multiselect.
                var build = function(select, tr) {
                    select.multiselect();
                    
                    if (select.length === 0) {
                        return 'Select not present anymore.';
                    }
                    
                    if (select.css('display') !== 'none') {
                        return 'Select still visible (expected <code>display: none;</code>).';
                    }
                    
                    if ($('button.multiselect', tr).length === 0) {
                        return 'Multiselect button not present.';
                    }
                    
                    if ($('option', select).length !== 5) {
                        return 'Not all options present anymore.';
                    }
                    
                    if ($('ul.multiselect-container', tr).length === 0) {
                        return 'Unordered list <code>.multiselect-container</code> not present.';
                    }
                    
                    if ($('ul.multiselect-container li', tr).length !== 5) {
                        return 'No list item for each option present.';
                    }
                    
                    if ($('ul.multiselect-container li a', tr).length !== 5) {
                        return 'Not all list items come with an anchor inside.';
                    }
                    
                    return false;
                }($('#test-build-select'), $('#test-build-tr'));
                
                if (build) {
                    $('#test-build-tr').removeClass('success').addClass('danger');
                    $('#test-build-tr td').last().html(build);
                }
                
                // Test build with optgroups.
                var buildOptgroups = function(select, tr) {
                    select.multiselect();
                    
                    if ($('optgroup', select).length !== 2) {
                        return 'Optgroups not present anymore (2 expected).';
                    }
                    
                    var first = $('optgroup', select).get(0);
                    var second = $('optgroup', select).get(1);
                    
                    if ($('option', $(first)).length !== 2) {
                        return 'First optgroup does not have 2 options.';
                    }
                    
                    if ($('option', $(second)).length !== 3) {
                        return 'Second optgroup does not have 3 options.';
                    }
                    
                    // Check the corresponding labels.
                    if ($('label.multiselect-group', tr).length !== 2) {
                        return 'Expected 2 labels within the unordered list.';
                    }
                    
                    // Check labeling of groups.
                    var firstLabel = $('label.multiselect-group', tr).get(0);
                    var secondLabel = $('label.multiselect-group', tr).get(1);
                    
                    if ($(firstLabel).text() !== $(first).prop('label')) {
                        return 'First group labeled incorrectly.';
                    }
                    
                    if ($(secondLabel).text() !== $(second).prop('label')) {
                        return 'Second group labeled incorrectly.';
                    }
                    
                    return false;
                }($('#test-build-optgroups-select'), $('#test-build-optgroups-tr'));
                
                if (buildOptgroups) {
                    $('#test-build-optgroups-tr').removeClass('success').addClass('danger');
                    $('#test-build-optgroups-tr td').last().html(build);
                }
                
                var buildSelected = function(select, tr ) {
                    select.multiselect();
                    
                    if ($('option:selected', select).length !== 1) {
                        return 'Multiselect did not adopt selected options (1 selected option).';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length !== 1) {
                        return 'Corresponding list item not set to <code>.active</code>.';
                    }
                    
                    return false;
                }($('#test-build-selected-select'), $('#test-build-selected-tr'));
                
                if (buildSelected) {
                    $('#test-build-selected-tr').removeClass('success').addClass('danger');
                    $('#test-build-selected-tr td').last().html(buildSelected);
                }
                
                var buildSelectAll = function(select, tr ) {
                    var value = 'multiselect-select-all';
                    select.multiselect({
                        includeSelectAllOption: true,
                        selectAllValue: value
                    });
                    
                    if ($('.multiselect-container input[value="' + value + '"]', tr).length !== 1) {
                        return 'Expected exactly one input with value ' + value + ' as select all option.';
                    }
                    
                    return false;
                }($('#test-build-select-all-select'), $('#test-build-select-all-tr'));
                
                if (buildSelectAll) {
                    $('#test-build-select-all-tr').removeClass('success').addClass('danger');
                    $('#test-build-select-all-tr td').last().html(buildSelectAll);
                }
                
                var buildFilter = function(select, tr) {
                    select.multiselect({
                        enableFiltering: true
                    });
                    
                    if ($('.multiselect-search', tr).length !== 1) {
                        return 'No search input present.';
                    }
                    
                }($('#test-build-filter-select'), $('#test-build-filter-tr'));
                
                if (buildFilter) {
                    $('#test-build-filter-tr').removeClass('success').addClass('danger');
                    $('#test-build-filter-tr td').last().html(buildFilter);
                }
                
                // Test select.
                var select = function(selectElement, tr) {
                    selectElement.multiselect();
                    
                    // Check for no selected options and no active li's.
                    if ($('option:selected', selectElement).length > 0) {
                        return 'There are already selected options (0 expected).';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length > 0) {
                        return 'There are already active list items (0 expected).';
                    }
                    
                    selectElement.multiselect('select', '1');
                    
                    if ($('option:selected', selectElement).length !== 1) {
                        return 'Just selected an option - option not marked selected.';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length !== 1) {
                        return 'Just selected an option - list item not set active.';
                    }
                    
                    if ($('option:selected', selectElement).first().val() !== '1') {
                        return 'Wrong option selected.';
                    }
                    
                    selectElement.multiselect('select', ['2', '3']);
                    
                    if ($('option:selected', selectElement).length !== 3) {
                        return 'Just selected two additional options - options not marked selected.';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length !== 3) {
                        return 'Just selected two additional options - list items not set active.';
                    }
                    
                    var second = $('option:selected', selectElement).get(1),
                        third = $('option:selected', selectElement).get(2);
                    
                    if (second === undefined || second.length === 0) {
                        return 'Could not get second option.';
                    }
                    
                    if (third === undefined || third.length === 0) {
                        return 'Could not get third option.';
                    }
                    
                    if ($(second).val() !== '2' || $(third).val() !== '3') {
                        return 'Wrong options selected.';
                    }
                    
                    return false;
                }($('#test-select-select'), $('#test-select-tr'));
                
                if (select) {
                    $('#test-select-tr').removeClass('success').addClass('danger');
                    $('#test-select-tr td').last().html(select);
                }
                
                // Test deselect.
                var deselect = function(select, tr) {
                    select.multiselect();
                    
                    // Check for no selected options and no active li's.
                    if ($('option:selected', select).length !== 3) {
                        return 'There should be 3 options selected.';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length !== 3) {
                        return 'There should be 3 list items set to active.';
                    }
                    
                    select.multiselect('deselect', '1');
                    
                    if ($('option:selected', select).length !== 2) {
                        return 'Just deselected an option - option not marked deselected.';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length !== 2) {
                        return 'Just deselected an option - list item not set inactive.';
                    }
                    
                    if ($('option:selected', select).first().val() !== '2') {
                        return 'Wrong option deselected.';
                    }
                    
                    select.multiselect('deselect', ['2', '3']);
                    
                    if ($('option:selected', select).length > 0) {
                        return 'Just deselected two additional options - options not marked deselected.';
                    }
                    
                    if ($('ul.multiselect-container li.active', tr).length > 0) {
                        return 'Just deselected two additional options - list items not set unactive.';
                    }
                    
                    return false;
                }($('#test-deselect-select'), $('#test-deselect-tr'));
                
                if (deselect) {
                    $('#test-deselect-tr').removeClass('success').addClass('danger');
                    $('#test-deselect-tr td').last().html(deselect);
                }
                
                var maxHeight = function(select, tr) {
                    
                    select.multiselect({
                        maxHeight: 100
                    });
                    
                    var height = $('.multiselect-container', tr).css('max-height');
                    if (height !== '100px') {
                        return 'Max height not set correctly (set: ' + height + ').';
                    }
                    
                    return false;
                }($('#test-max-height-select'), $('#test-max-height-tr'));
                
                if (maxHeight) {
                    $('#test-max-height-tr').removeClass('success').addClass('danger');
                    $('#test-max-height-tr td').last().html(maxHeight);
                }
            });
        </script>
