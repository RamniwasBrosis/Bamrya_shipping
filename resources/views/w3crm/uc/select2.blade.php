@extends('layouts.default')
@section('content')
<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Plugins</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Select2</a></li>
        </ol>
    </div>
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Single select boxes</h4>
                        <p>Select2 can take a regular select box like this...</p>
                    </div>

                    <select id="single-select">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Multi-select boxes</h4>
                        <p>Select2 also supports multi-value select boxes. The select below is declared with the multiple <mark class="text-primary">attribute</mark>.</p>
                    </div>
                    <select class="multi-select" name="states[]" multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                        <option value="UI">dlf</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Dropdown option groups</h4>
                        <p>In HTML, <code>&lt;option&gt;</code> elements can be grouped by wrapping them with in <br> an <code>&lt;optgroup&gt;</code> element: </p>
                    </div>

                    <select class="dropdown-groups">
                        <optgroup label="Group Name">
                            <option>Nested option 1</option>
                            <option>Nested option 2</option>
                            <option>Nested option 3</option>
                        </optgroup>
                        <optgroup label="Another Group Name">
                            <option>Nested option 1</option>
                            <option>Nested option 2</option>
                            <option>Nested option 3</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Disabling options</h4>
                        <p>Select2 will correctly handle disabled options when <code>disabled</code> attribute is set) and from remote srouces where the object has <code>disabled:
                                true</code> set.</p>
                    </div>
                    <select class="disabling-options">
                        <option value="one">First</option>
                        <option value="two" disabled="disabled">Second (disabled)</option>
                        <option value="three">Third</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Disabling a Select2 control</h4>
                        <p>Select2 will respond to the <code>disabled</code> attribute on
                            <code>&lt;select&gt;</code> elements. You can also initialize Select2 with
                            <code>disabled: true</code> to get the same effect.</p>
                    </div>

                    <div class="mb-3">
                        <select class="js-example-disabled">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="js-example-disabled-multi" name="states[]" multiple="multiple">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>

                    <button class="btn btn-primary me-2" id="js-programmatic-enable">Enable</button>
                    <button class="btn btn-danger light" id="js-programmatic-disable">Disable</button>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Select2 With Labels</h4>
                        <p>You can, and should, use a <code>&lt;label&gt;</code> with Select2, just like any other <code>&lt;select&gt;</code> element.</p>
                    </div>

                    <label class="mb-4 select2-label" for="id_label_single">
                        <span class="d-block">Click this to highlight the single select element</span> <br>

                        <select class="select2-with-label-single js-states d-block" id="id_label_single">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </label>

                    <label class="select2-label" for="id_label_multiple">
                        <span class="d-block">Click this to highlight the multiple select element</span> <br>

                        <select class="select2-with-label-multiple js-states" id="id_label_multiple"
                            multiple="multiple">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Container Width</h4>
                        <p>The two Select2 boxes below are styled to <code>50%</code> and <code>75%</code> width respectively to support responsive design:</p>
                    </div>

                    <div class="mb-3">
                        <select class="select2-width-50" style="width: 50%">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="select2-width-75" multiple="multiple" style="width: 75%">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Themes</h4>
                        <p>Select2 supports custom themes using the <code>theme</code> option so you can style Select2 to match the rest of your application.</p>
                    </div>

                    <div class="mb-3">
                        <select class="select2-width-50" style="width: 50%">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="select2-width-75" multiple="multiple" style="width: 75%">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Ajax (remote data)</h4>
                        <p>Select2 comes with AJAX support built in, using jQuery's AJAX methods. In this example, we can search for repositories using GitHub's API:</p>
                    </div>

                    <select class="js-data-example-ajax w-100">

                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Loading array data</h4>
                        <p>You may use the <code>data</code> configuration option to load dropdown options from a local array.</p>
                    </div>

                    <select class="js-example-data-array">

                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Automatic Selection</h4>
                        <p>Select2 can be configured to automatically select the currently highlighted result when the dropdown is btn-closed by using the <code>selectOnbtn-close</code> option:
                        </p>
                    </div>

                    <select id="automatic-selection">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Remain open after selection</h4>
                        <p>Select2 will automatically btn-close the dropdown when an element is selected, similar to what is done with a normal select box. You may use the
                            <code>btn-closeOnSelect</code> option to prevent the dropdown from closing when a result is selected:</p>
                    </div>

                    <select id="remain-open">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Dropdown placement</h4>
                        <p>The <code>dropdownParent</code> option allows you to pick an alternative element for the dropdown to be appended to:</p>
                    </div>

                    <select id="dropdown-placement">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    <div id="select2-modal">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Limiting the number of selections</h4>
                        <p>Select2 multi-value select boxes can set restrictions regarding the maximum number of options that can be selected. The select below is declared with the
                            <code>multiple</code> attribute with <code>maximumSelectionLength</code> in the select2 options.</p>
                    </div>

                    <select id="limit-selection" name="states[]" multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                        <option value="BY">Lorem</option>
                        <option value="DY">Ipsum</option>
                        <option value="MY">Dolor</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Dynamic option creation</h4>
                        <p>In addition to a prepopulated menu of options, Select2 can dynamically create new options from text input by the user in the search box. This feature is called "tagging". To enable tagging, set the <code>tags</code>                                        option to
                            <code>true</code>:</p>
                    </div>
                    <select id="dynamic-option-creation">
                        <option value="AL">Red</option>
                        <option value="WY">Green</option>
                        <option value="BY">Yellow</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Tagging with multi-value select boxes</h4>
                        <p>Tagging can also be used in multi-value select boxes. In the example below, we set the <code>multiple="multiple"</code> attribute on a Select2 control that also has <code>tags: true</code> enabled:</p>
                    </div>

                    <select id="multi-value-select" multiple="multiple">
                        <option selected="selected">orange</option>
                        <option>white</option>
                        <option selected="selected">purple</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Single select placeholders</h4>
                        <p>Select2 supports displaying a placeholder value using the
                            <code>placeholder</code> configuration option. The placeholder value will be displayed until a selection is made.</p>
                    </div>

                    <select class="single-select-placeholder js-states">

                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Multi-select placeholders</h4>
                        <p>For multi-selects, you must <strong>not</strong> have an empty
                            <code>&lt;option&gt;</code>element:</p>
                    </div>

                    <select class="multi-select-placeholder js-states" multiple="multiple">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Default selection placeholders</h4>
                        <p>Alternatively, the value of the <code>placeholder</code> option can be a data object representing a default selection (<code>&lt;option&gt;</code>). In this case the <code>id</code> of the data object should match the
                            <code>value</code> of the corresponding default selection.</p>
                    </div>

                    <select class="default-placeholder">

                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Customizing how results are matched</h4>
                        <p>When users filter down the results by entering search terms into the search box, Select2 uses an internal "matcher" to match search terms to results. You may customize the way that Select2 matches search terms by specifying
                            a callback for the <code>matcher</code> configuration option.</p>
                    </div>

                    <select class="customize-result">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Matching grouped options</h4>
                        <p>Only first-level objects will be passed in to the <code>matcher</code> callback. If you are working with nested data, you must iterate through the
                            <code>children</code> array and match them individually. This allows for more advanced matching when working with nested objects, allowing you to handle them however you want.</p>
                    </div>

                    <select class="match-grouped-options">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                            <option>Alaska</option>
                            <option>Hawaii</option>
                        </optgroup>
                        <optgroup label="Pacific Time Zone">
                            <option>California</option>
                            <option>Nevada</option>
                            <option>Oregon</option>
                            <option>Washington</option>
                        </optgroup>
                        <optgroup label="Mountain Time Zone">
                            <option>Arizona</option>
                            <option>Colorado</option>
                            <option>Idaho</option>
                            <option>Mountana</option>
                            <option>Nebraska</option>
                            <option>New Mexico</option>
                            <option>Utah</option>
                            <option>Wyoming</option>
                        </optgroup>
                        <optgroup label="Central Time Zone">
                            <option>Alabama</option>
                            <option>Arkansas</option>
                            <option>Illinois</option>
                            <option>Lowa</option>
                            <option>Kansas</option>
                        </optgroup>
                        <optgroup label="Eastern Time Zone">
                            <option>Connecticut</option>
                            <option>Delaware</option>
                            <option>Florida</option>
                            <option>Georgia</option>
                            <option>Indiana</option>
                            <option>Maine</option>
                            <option>Maryland</option>
                            <option>Massachusetts</option>
                            <option>Michigan</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Minumum search term length</h4>
                        <p>You may set a minimum search term length by using the
                            <code>minimumInputLength</code> option:</p>
                    </div>

                    <select class="minimum-search-length">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Maximum search term length</h4>
                        <p>You may limit the maximum length of search terms by using the
                            <code>maximumInputLength</code> option:</p>
                    </div>

                    <select class="maximum-search-length">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Programmatically add new options</h4>
                        <p>New options can be added to a Select2 control programmatically by creating a new Javascript <code>Option</code> object and appending it to the control:</p>
                    </div>

                    <select class="add-new-options">

                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Create if not exists</h4>
                        <p>You can use <code>.find</code> to select the option if it already exists, and create it otherwise:</p>
                    </div>

                    <select class="create-if-not-exists">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Using jQuery selector</h4>
                        <p>Selected items can also be accessed via the <code>:selected</code> jQuery selector:
                        </p>
                    </div>

                    <select class="jquery-selector">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">RTL support</h4>
                        <p>Select2 will work on RTL websites if the <code>dir</code> attribute is set on the
                            <code>&lt;select&gt;</code><span class="copy-to-clipboard" title="Copy to clipboard"></span> or any parents of it. You can also initialize Select2 with the <code>dir: "rtl"</code><span class="copy-to-clipboard"
                                title="Copy to clipboard"></span> configuration option.
                        </p>
                    </div>

                    <select class="rtl-select2">
                        <option value="Alaska">Alaska</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="California">California</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Destroying the Select2 control</h4>
                        <p>The <code>destroy</code> method will remove the Select2 widget from the target element. It will revert back to a standard <code>select</code> control:</p>
                    </div>

                    <div class="mb-4">
                        <select class="destroy-selector">
                            <option value="Alaska">Alaska</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="California">California</option>
                        </select>
                    </div>
                    <button id="destroy-selector-trigger" class="btn btn-primary">Destroy Select2</button>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Opening the dropdown</h4>
                        <p>Select2 will trigger a few different events when different actions are taken using the component, allowing you to add custom hooks and perform actions.</p>
                    </div>

                    <div class="mb-4">
                        <select class="opening-dropdown">
                            <option value="Alaska">Alaska</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="California">California</option>
                        </select>
                    </div>
                    <button id="dropdown-trigger-open" class="btn btn-primary">Open Dropdown</button>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Opening/Closing the dropdown</h4>
                        <p>Select2 will trigger a few different events when different actions are taken using the component, allowing you to add custom hooks and perform actions.</p>
                    </div>
                    <button id="opening-dropdown-trigger" class="btn btn-primary mb-2">Open
                        Dropdown</button>
                    <button id="closing-dropdown-trigger" class="btn btn-primary mb-2">btn-close
                        Dropdown</button>
                    <div class="mt-4">
                        <select class="open-close-dropdown">
                            <option value="Alaska">Alaska</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="California">California</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Select2 methods</h4>
                        <p>Select2 has several built-in methods that allow programmatic control of the component. </p>
                    </div>

                    <label class="select2-label form-label">Single select</label> <br>
                    <button class="js-programmatic-set-val btn btn-primary mb-2" aria-label="Set Select2 option">
                        Set "California"
                    </button>

                    <button class="js-programmatic-open btn btn-primary mb-2">
                        Open
                    </button>

                    <button class="js-programmatic-btn-close btn btn-primary mb-2">
                        btn-close
                    </button>

                    <button class="js-programmatic-destroy btn btn-primary mb-2">
                        Destroy
                    </button>

                    <button class="js-programmatic-init btn btn-primary mb-2">
                        Re-initialize
                    </button>

                    <div class="mt-4">
                        <select class="single-event-unbind">
                            <option value="AL">Alaska</option>
                            <option value="HA">Hawaii</option>
                            <option value="CA">California</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Select2 methods</h4>
                        <p>Select2 has several built-in methods that allow programmatic control of the component. </p>
                    </div>

                    <label class="select2-label form-label">Multiple select</label> <br>
                    <button class="js-programmatic-multi-set-val btn btn-primary mb-2" aria-label="Set Select2 option">
                        Set to Hawaii and California
                    </button>

                    <button class="js-programmatic-multi-clear btn btn-primary mb-2">
                        Clear
                    </button>

                    <div class="mt-4">
                        <select class="js-example-programmatic-multi" multiple="multiple">
                            <option value="AL">Alaska</option>
                            <option value="HA">Hawaii</option>
                            <option value="CA">California</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
