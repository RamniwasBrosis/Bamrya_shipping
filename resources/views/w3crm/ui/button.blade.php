@extends('layouts.default')
@section('content')
		<div class="page-titles">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item ps-0"><a href="#">Bootstrap</a></li>
				<li class="breadcrumb-item active" aria-current="page">Button</li>
			  </ol>
			</nav>
		</div>
            <div class="container-fluid">
				<div class="row ">
					<div class="col-xl-12">

                    </div>
                </div>
				 <!--element-area-->
				 <div class="element-area">
                    <div class="demo-view">
                        <div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">
							<!-- row -->
							<div class="row">
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="default-button">
										<div class="card-header flex-wrap d-flex justify-content-between border-0">
											<div>
												<h4 class="card-title">Buttons</h4>
												<p class="mb-0 subtitle">Default button style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#Buttons" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#Buttons-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Buttons" role="tabpanel" aria-labelledby="home-tab">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary">Primary</button>
													<button type="button" class="btn btn-secondary">Secondary</button>
													<button type="button" class="btn btn-success">Success</button>
													<button type="button" class="btn btn-danger">Danger</button>
													<button type="button" class="btn btn-warning">Warning</button>
													<button type="button" class="btn btn-info">Info</button>
													<button type="button" class="btn btn-light">Light</button>
													<button type="button" class="btn btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="Buttons-html" role="tabpanel" aria-labelledby="home-tab">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">
&lt;button type="button" class="btn btn-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn btn-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
								 <!-- Column  -->
								 <div class="col-lg-12">
									<div class="card dz-card" id="buttons-with-icon">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Buttons With Icon</h4>
												<p class="mb-0 subtitle">Default button style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-1" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-1" data-bs-toggle="tab" data-bs-target="#Buttons-Icon" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-1" data-bs-toggle="tab" data-bs-target="#Buttons-Icon-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-1">
											<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary"><i class="fa-brands fa-accusoft me-2"></i>Primary</button>
													<button type="button" class="btn btn-secondary"><i class="fa-solid fa-table-cells-large me-2"></i>Secondary</button>
													<button type="button" class="btn btn-success"><i class="fa-solid fa-gear me-2"></i>Success</button>
													<button type="button" class="btn btn-danger"><i class="fa-solid fa-circle-exclamation me-2"></i>Danger</button>
													<button type="button" class="btn btn-warning"><i class="fa-solid fa-image me-2"></i>Warning</button>
													<button type="button" class="btn btn-info"><i class="fa-solid fa-phone-volume me-2"></i>Info</button>
													<button type="button" class="btn btn-light"><i class="fa-solid fa-lock me-2"></i>Light</button>
													<button type="button" class="btn btn-dark"><i class="fa-solid fa-circle-play me-2"></i>Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="Buttons-Icon-html" role="tabpanel" aria-labelledby="home-tab">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">
	&lt;button type="button" class="btn btn-primary"&gt;&lt;i class="fa-solid fa-table-cells-large me-2"&gt;&lt;/i&gt;Primary&lt;/button&gt;
	&lt;button type="button" class="btn btn-secondary"&gt;&lt;i class="fa-solid fa-square me-2"&gt;&lt;/i&gt;Secondary&lt;/button&gt;
	&lt;button type="button" class="btn btn-success"&gt;&lt;i class="fa-solid fa-gear me-2"&gt;&lt;/i&gt;Success&lt;/button&gt;
	&lt;button type="button" class="btn btn-danger"&gt;&lt;i class="fa-solid fa-circle-exclamation me-2"&gt;&lt;/i&gt;Danger&lt;/button&gt;
	&lt;button type="button" class="btn btn-warning"&gt;&lt;i class="fa-solid fa-image me-2"&gt;&lt;/i&gt;Warning&lt;/button&gt;
	&lt;button type="button" class="btn btn-info"&gt;&lt;i class="fa-solid fa-phone-volume me-2"&gt;&lt;/i&gt;Info&lt;/button&gt;
	&lt;button type="button" class="btn btn-light"&gt;&lt;i class="fa-solid fa-lock me-2"&gt;&lt;/i&gt;Light&lt;/button&gt;
	&lt;button type="button" class="btn btn-dark"&gt;&lt;i class="fa-solid fa-circle-play me-2"&gt;&lt;/i&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="button-light">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Buttons</h4>
												<p class="mb-0 subtitle">Button Light style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-2" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-2" data-bs-toggle="tab" data-bs-target="#LightStyle" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-2" data-bs-toggle="tab" data-bs-target="#LightStyle-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-2">
											<div class="tab-pane fade show active" id="LightStyle" role="tabpanel" aria-labelledby="home-tab-2">
												<div class="card-body pt-0">
													<button type="button" class="btn light btn-primary">Primary</button>
													<button type="button" class="btn light btn-secondary">Secondary</button>
													<button type="button" class="btn light btn-success">Success</button>
													<button type="button" class="btn light btn-danger">Danger</button>
													<button type="button" class="btn light btn-warning">Warning</button>
													<button type="button" class="btn light btn-info">Info</button>
													<button type="button" class="btn light btn-light">Light</button>
													<button type="button" class="btn light btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade" id="LightStyle-html" role="tabpanel" aria-labelledby="home-tab-2">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn light btn-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn light btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn light btn-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn light btn-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn light btn-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn light btn-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn light btn-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn light btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="default-outline-button">
										<div class="card-header flex-wrap d-flex justify-content-between border-0">
											<div>
												<h4 class="card-title">Outline Buttons</h4>
												<p class="mb-0 subtitle">Default outline button style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-3" data-bs-toggle="tab" data-bs-target="#OutlineButtons" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-3" data-bs-toggle="tab" data-bs-target="#OutlineButtons-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-3">
											<div class="tab-pane fade show active" id="OutlineButtons" role="tabpanel" aria-labelledby="home-tab-3">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-outline-primary">Primary</button>
													<button type="button" class="btn btn-outline-secondary">Secondary</button>
													<button type="button" class="btn btn-outline-success">Success</button>
													<button type="button" class="btn btn-outline-danger">Danger</button>
													<button type="button" class="btn btn-outline-warning">Warning</button>
													<button type="button" class="btn btn-outline-info">Info</button>
													<button type="button" class="btn btn-outline-light">Light</button>
													<button type="button" class="btn btn-outline-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="OutlineButtons-html" role="tabpanel" aria-labelledby="home-tab-3">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">&lt;button type="button" class="btn btn-outline-primary"&gt;Primary&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-secondary"&gt;Secondary&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-success"&gt;Success&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-danger"&gt;Danger&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-warning"&gt;Warning&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-info"&gt;Info&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-light"&gt;Light&lt;/button&gt;
	&lt;button type="button" class="btn btn-outline-dark"&gt;Dark&lt;/button&gt;</code></pre>

												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="button-sizes">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Button Sizes</h4>
												<p class="mb-0 subtitle">add <code>.btn-lg .btn-sm .btn-xs</code> to change the style
											</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-4" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-4" data-bs-toggle="tab" data-bs-target="#ButtonSizes" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-4" data-bs-toggle="tab" data-bs-target="#ButtonSizes-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-4">
											<div class="tab-pane fade show active" id="ButtonSizes" role="tabpanel" aria-labelledby="home-tab-4">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary btn-lg">Large Button</button>
													<button type="button" class="btn btn-primary">Default Button</button>
													<button type="button" class="btn btn-primary btn-xs">Extra Small Button</button>
													<button type="button" class="btn btn-primary btn-sm">Small Button</button>
													<button type="button" class="btn btn-primary btn-xxs">Extra Small Button</button>
												</div>
											</div>
											<div class="tab-pane fade" id="ButtonSizes-html" role="tabpanel" aria-labelledby="home-tab-4">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-primary btn-lg"&gt;Large Button&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary"&gt;Default Button&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-sm"&gt;Small Button&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-xs"&gt;Extra Small Button&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-xxs"&gt;Extra Small Button&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
								  <!-- Column  -->
								  <div class="col-lg-12">
									<div class="card dz-card" id="button-sizes-icon">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Button Sizes Icon</h4>
												<p class="mb-0 subtitle">add <code>.btn-lg .btn-sm .btn-xs</code> to change the style
											</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-5" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-5" data-bs-toggle="tab" data-bs-target="#ButtonSizesIcon" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-5" data-bs-toggle="tab" data-bs-target="#ButtonSizesIcon-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-5">
											<div class="tab-pane fade show active" id="ButtonSizesIcon" role="tabpanel" aria-labelledby="home-tab-5">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary btn-icon-lg"><i class="fa-solid fa-house-chimney"></i></button>
													<button type="button" class="btn btn-primary btn-icon-md"><i class="fa-solid fa-house-chimney"></i></button>
													<button type="button" class="btn btn-primary btn-icon-sm"><i class="fa-solid fa-house-chimney"></i></button>
													<button type="button" class="btn btn-primary btn-icon-xs"><i class="fa-solid fa-house-chimney"></i></button>
													<button type="button" class="btn btn-primary btn-icon-xxs"><i class="fa-solid fa-house-chimney"></i></button>
												</div>
											</div>
											<div class="tab-pane fade" id="ButtonSizesIcon-html" role="tabpanel" aria-labelledby="home-tab-5">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-primary btn-icon-lg"&gt;&lt;i class="fa-solid fa-house-chimney"&gt;&lt;/i&gt;&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-icon-md"&gt;&lt;i class="fa-solid fa-house-chimney"&gt;&lt;/i&gt;&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-icon-sm"&gt;&lt;i class="fa-solid fa-house-chimney"&gt;&lt;/i&gt;&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-icon-xs"&gt;&lt;i class="fa-solid fa-house-chimney"&gt;&lt;/i&gt;&lt;/button&gt;
	&lt;button type="button" class="btn btn-primary btn-icon-xxs"&gt;&lt;i class="fa-solid fa-house-chimney"&gt;&lt;/i&gt;&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="outline-button-sizes">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Outline Button Sizes</h4>
												<p class="mb-0 subtitle">add <code>.btn-lg .btn-sm .btn-xs</code> to change the style
											</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-6" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-6" data-bs-toggle="tab" data-bs-target="#outlineButtonSizes" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-6" data-bs-toggle="tab" data-bs-target="#outlineButtonSizes-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-6">
											<div class="tab-pane fade show active" id="outlineButtonSizes" role="tabpanel" aria-labelledby="home-tab-6">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-outline-primary btn-lg">Large button</button>
													<button type="button" class="btn btn-outline-primary btn-md">Medium button</button>
													<button type="button" class="btn btn-outline-primary">Default button</button>
													<button type="button" class="btn btn-outline-primary btn-xs">Small button</button>
													<button type="button" class="btn btn-outline-primary btn-sm">Extra small button</button>
												</div>
											</div>
											<div class="tab-pane fade" id="outlineButtonSizes-html" role="tabpanel" aria-labelledby="home-tab-6">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-outline-primary btn-lg"&gt;Large button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-primary"&gt;Default button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-primary btn-md"&gt;Small button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-primary btn-sm"&gt;Small button&lt;/button&gt;
&lt;button type="button" class="btn btn-outline-primary btn-xs"&gt;Extra small button&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="rounded-buttons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Rounded Buttons</h4>
												<p class="mb-0 subtitle">add <code>.btn-rounded</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-7" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-7" data-bs-toggle="tab" data-bs-target="#RoundedButtons" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-7" data-bs-toggle="tab" data-bs-target="#RoundedButtons-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-7">
											<div class="tab-pane fade show active" id="RoundedButtons" role="tabpanel" aria-labelledby="home-tab-7">
												<div class="card-body pt-0">

													<button type="button" class="btn btn-rounded btn-primary">Primary</button>
													<button type="button" class="btn btn-rounded btn-secondary">Secondary</button>
													<button type="button" class="btn btn-rounded btn-success">Success</button>
													<button type="button" class="btn btn-rounded btn-danger">Danger</button>
													<button type="button" class="btn btn-rounded btn-warning">Warning</button>
													<button type="button" class="btn btn-rounded btn-info">Info</button>
													<button type="button" class="btn btn-rounded btn-light">Light</button>
													<button type="button" class="btn btn-rounded btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade" id="RoundedButtons-html" role="tabpanel" aria-labelledby="home-tab-7">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-rounded btn-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="rounded-outline-buttons">
										<div class="card-header flex-wrap d-flex border-0 justify-content-between">
											<div>
											<h4 class="card-title">Rounded outline Buttons</h4>
											<p class="mb-0 subtitle">add <code>.btn-rounded</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-8" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-8" data-bs-toggle="tab" data-bs-target="#RoundedOutline" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-8" data-bs-toggle="tab" data-bs-target="#RoundedOutline-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-8">
											<div class="tab-pane fade show active" id="RoundedOutline" role="tabpanel" aria-labelledby="home-tab-8">
												<div class="card-body pt-0">
													<div class="rounded-button">
														<button type="button" class="btn btn-rounded btn-outline-primary">Primary</button>
														<button type="button" class="btn btn-rounded btn-outline-secondary">Secondary</button>
														<button type="button" class="btn btn-rounded btn-outline-success">Success</button>
														<button type="button" class="btn btn-rounded btn-outline-danger">Danger</button>
														<button type="button" class="btn btn-rounded btn-outline-warning">Warning</button>
														<button type="button" class="btn btn-rounded btn-outline-info">Info</button>
														<button type="button" class="btn btn-rounded btn-outline-light">Light</button>
														<button type="button" class="btn btn-rounded btn-outline-dark">Dark</button>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="RoundedOutline-html" role="tabpanel" aria-labelledby="home-tab-8">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;div class="rounded-button"&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-primary"&gt;Primary&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-secondary"&gt;Secondary&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-success"&gt;Success&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-danger"&gt;Danger&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-warning"&gt;Warning&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-info"&gt;Info&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-light"&gt;Light&lt;/button&gt;
	&lt;button type="button" class="btn btn-rounded btn-outline-dark"&gt;Dark&lt;/button&gt;
&lt;/div&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="button-right-icons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Button Right icons</h4>
												<p class="mb-0 subtitle">add <code>.btn-icon-end</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-9" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-9" data-bs-toggle="tab" data-bs-target="#ButtonRightIcons" type="button" role="tab" aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-9" data-bs-toggle="tab" data-bs-target="#ButtonRightIcons-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-9">
											<div class="tab-pane fade show active" id="ButtonRightIcons" role="tabpanel" aria-labelledby="home-tab-9">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary">Add to cart <span
															class="btn-icon-end"><i class="fa fa-shopping-cart"></i></span>
													</button>
													<button type="button" class="btn btn-info">Add to wishlist <span
															class="btn-icon-end"><i class="fa fa-heart"></i></span>
													</button>
													<button type="button" class="btn btn-danger">Remove <span class="btn-icon-end"><i class="fas fa-times"></i></span>
													</button>
													<button type="button" class="btn btn-secondary">Sent message <span
															class="btn-icon-end"><i class="fa fa-envelope"></i></span>
													</button>
													<button type="button" class="btn btn-warning">Add bookmark <span
															class="btn-icon-end"><i class="fa fa-star"></i></span>
													</button>
													<button type="button" class="btn btn-success">Success <span class="btn-icon-end"><i
																class="fa fa-check"></i></span>
													</button>
												</div>
											</div>
											<div class="tab-pane fade " id="ButtonRightIcons-html" role="tabpanel" aria-labelledby="home-tab-9">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">&lt;button type="button" class="btn btn-primary"&gt;Add to cart &lt;span
class="btn-icon-end"&gt;&lt;i class="fa fa-shopping-cart"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-info"&gt;Add to wishlist &lt;span
class="btn-icon-end"&gt;&lt;i class="fa fa-heart"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-danger"&gt;Remove &lt;span class="btn-icon-end"&gt;&lt;i class="fas fa-times"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-secondary"&gt;Sent message &lt;span
class="btn-icon-end"&gt;&lt;i class="fa fa-envelope"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-warning"&gt;Add bookmark &lt;span
class="btn-icon-end"&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-success"&gt;Success &lt;span class="btn-icon-end"&gt;&lt;i
	class="fa fa-check"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="button-left-icons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Button Left icons</h4>
												<p class="mb-0 subtitle">add <code>.btn-icon-start</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-10" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-10" data-bs-toggle="tab" data-bs-target="#ButtonLeftIcons" type="button" role="tab" aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-10" data-bs-toggle="tab" data-bs-target="#ButtonLeftIcons-html" type="button" role="tab" aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-10">
											<div class="tab-pane fade show active" id="ButtonLeftIcons" role="tabpanel" aria-labelledby="home-tab-10">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-primary"><span
															class="btn-icon-start text-primary"><i class="fa fa-shopping-cart"></i>
														</span>Buy</button>
													<button type="button" class="btn btn-info"><span
															class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
														</span>Add</button>
													<button type="button" class="btn btn-danger"><span
															class="btn-icon-start text-danger"><i class="fa fa-envelope color-danger"></i>
														</span>Email</button>
													<button type="button" class="btn btn-secondary"><span
															class="btn-icon-start text-secondary"><i
																class="fa fa-share-alt color-secondary"></i> </span>Share</button>
													<button type="button" class="btn btn-warning"><span
															class="btn-icon-start text-warning"><i class="fa fa-download color-warning"></i>
														</span>Download</button>
													<button type="button" class="btn btn-success"><span
															class="btn-icon-start text-success"><i class="fa fa-upload color-success"></i>
														</span>Upload</button>
												</div>
											</div>
											<div class="tab-pane fade" id="ButtonLeftIcons-html" role="tabpanel" aria-labelledby="home-tab-10">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-rounded btn-primary"&gt;&lt;span
	class="btn-icon-start text-primary"&gt;&lt;i class="fa fa-shopping-cart"&gt;&lt;/i&gt;
&lt;/span&gt;Buy&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-info"&gt;&lt;span
	class="btn-icon-start text-info"&gt;&lt;i class="fa fa-plus color-info"&gt;&lt;/i&gt;
&lt;/span&gt;Add&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-danger"&gt;&lt;span
	class="btn-icon-start text-danger"&gt;&lt;i class="fa fa-envelope color-danger"&gt;&lt;/i&gt;
&lt;/span&gt;Email&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-secondary"&gt;&lt;span
	class="btn-icon-start text-secondary"&gt;&lt;i
		class="fa fa-share-alt color-secondary"&gt;&lt;/i&gt; &lt;/span&gt;Share&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-warning"&gt;&lt;span
	class="btn-icon-start text-warning"&gt;&lt;i class="fa fa-download color-warning"&gt;&lt;/i&gt;
&lt;/span&gt;Download&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-success"&gt;&lt;span
	class="btn-icon-start text-success"&gt;&lt;i class="fa fa-upload color-success"&gt;&lt;/i&gt;
&lt;/span&gt;Upload&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="square-buttons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Square Buttons</h4>
												<p class="mb-0 subtitle">add <code>.btn-square</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-11" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-11" data-bs-toggle="tab" data-bs-target="#SquareButtons" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-11" data-bs-toggle="tab" data-bs-target="#SquareButtons-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-11">
											<div class="tab-pane fade show active" id="SquareButtons" role="tabpanel" aria-labelledby="home-tab-11">
												<div class="card-body pt-0">
													<button type="button" class="btn  btn-square btn-primary">Primary</button>
													<button type="button" class="btn  btn-square btn-secondary">Secondary</button>
													<button type="button" class="btn  btn-square btn-success">Success</button>
													<button type="button" class="btn  btn-square btn-danger">Danger</button>
													<button type="button" class="btn  btn-square btn-warning">Warning</button>
													<button type="button" class="btn  btn-square btn-info">Info</button>
													<button type="button" class="btn  btn-square btn-light">Light</button>
													<button type="button" class="btn  btn-square btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="SquareButtons-html" role="tabpanel" aria-labelledby="home-tab-11">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn  btn-square btn-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn  btn-square btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="square-outline-buttons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Square Outline Buttons</h4>
												<p class="mb-0 subtitle">add <code>.btn-square</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-12" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-12" data-bs-toggle="tab" data-bs-target="#SquareOutline" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-12" data-bs-toggle="tab" data-bs-target="#SquareOutline-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-12">
											<div class="tab-pane fade show active" id="SquareOutline" role="tabpanel" aria-labelledby="home-tab-12">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-square btn-outline-primary">Primary</button>
													<button type="button" class="btn btn-square btn-outline-secondary">Secondary</button>
													<button type="button" class="btn btn-square btn-outline-success">Success</button>
													<button type="button" class="btn btn-square btn-outline-danger">Danger</button>
													<button type="button" class="btn btn-square btn-outline-warning">Warning</button>
													<button type="button" class="btn btn-square btn-outline-info">Info</button>
													<button type="button" class="btn btn-square btn-outline-light">Light</button>
													<button type="button" class="btn btn-square btn-outline-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade" id="SquareOutline-html" role="tabpanel" aria-labelledby="home-tab-12">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">&lt;button type="button" class="btn btn-square btn-outline-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn btn-square btn-outline-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="rounded-button">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Rounded Button</h4>
												<p class="mb-0 subtitle">add <code>.btn-rounded</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-13" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-13" data-bs-toggle="tab" data-bs-target="#RoundedButton2" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-13" data-bs-toggle="tab" data-bs-target="#RoundedButton2-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-13">
											<div class="tab-pane fade show active" id="RoundedButton2" role="tabpanel" aria-labelledby="home-tab-13">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-rounded btn-primary">Primary</button>
													<button type="button" class="btn btn-rounded btn-secondary">Secondary</button>
													<button type="button" class="btn btn-rounded btn-success">Success</button>
													<button type="button" class="btn btn-rounded btn-danger">Danger</button>
													<button type="button" class="btn btn-rounded btn-warning">Warning</button>
													<button type="button" class="btn btn-rounded btn-info">Info</button>
													<button type="button" class="btn btn-rounded btn-light">Light</button>
													<button type="button" class="btn btn-rounded btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="RoundedButton2-html" role="tabpanel" aria-labelledby="home-tab-13">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-rounded btn-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="rounded-outline-buttons-1">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Rounded outline Buttons</h4>
												<p class="mb-0 subtitle">add <code>.btn-rounded</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-14" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-14" data-bs-toggle="tab" data-bs-target="#RoundedOutlineButton2" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-14" data-bs-toggle="tab" data-bs-target="#RoundedOutlineButton2-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-14">
											<div class="tab-pane fade show active" id="RoundedOutlineButton2" role="tabpanel" aria-labelledby="home-tab-14">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-rounded btn-outline-primary">Primary</button>
													<button type="button" class="btn btn-rounded btn-outline-secondary">Secondary</button>
													<button type="button" class="btn btn-rounded btn-outline-success">Success</button>
													<button type="button" class="btn btn-rounded btn-outline-danger">Danger</button>
													<button type="button" class="btn btn-rounded btn-outline-warning">Warning</button>
													<button type="button" class="btn btn-rounded btn-outline-info">Info</button>
													<button type="button" class="btn btn-rounded btn-outline-light">Light</button>
													<button type="button" class="btn btn-rounded btn-outline-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="RoundedOutlineButton2-html" role="tabpanel" aria-labelledby="home-tab-14">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-rounded btn-outline-primary"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-secondary"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-success"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-danger"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-warning"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-info"&gt;Info&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-light"&gt;Light&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-outline-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="dropdown-button">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Dropdown Button</h4>
												<p class="mb-0 subtitle">Default dropdown button style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-15" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-15" data-bs-toggle="tab" data-bs-target="#DropdownButton" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-15" data-bs-toggle="tab" data-bs-target="#DropdownButton-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-15">
											<div class="tab-pane fade show active" id="DropdownButton" role="tabpanel" aria-labelledby="home-tab-15">
												<div class="card-body pt-0">
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Primary</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
														</div>
													</div>
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Secondary</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
														</div>
													</div>
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">Success</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
														</div>
													</div>
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">Warning</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
														</div>
													</div>
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Danger</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
															<a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade " id="DropdownButton-html" role="tabpanel" aria-labelledby="home-tab-15">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;div class="btn-group" role="group"&gt;
	&lt;button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"&gt;Primary&lt;/button&gt;
	&lt;div class="dropdown-menu"&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="btn-group" role="group"&gt;
	&lt;button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"&gt;Secondary&lt;/button&gt;
	&lt;div class="dropdown-menu"&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="btn-group" role="group"&gt;
	&lt;button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"&gt;Success&lt;/button&gt;
	&lt;div class="dropdown-menu"&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="btn-group" role="group"&gt;
	&lt;button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown"&gt;Warning&lt;/button&gt;
	&lt;div class="dropdown-menu"&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="btn-group" role="group"&gt;
	&lt;button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"&gt;Danger&lt;/button&gt;
	&lt;div class="dropdown-menu"&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
		&lt;a class="dropdown-item" href="javascript:void(0);"&gt;Dropdown link&lt;/a&gt;
	&lt;/div&gt;
&lt;/div&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="buttons-transparent">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Buttons Transparent</h4>
												<p class="mb-0 subtitle">Button transparent style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-16" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-16" data-bs-toggle="tab" data-bs-target="#ButtonsTransparent" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-16" data-bs-toggle="tab" data-bs-target="#ButtonsTransparent-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-16">
											<div class="tab-pane fade show active" id="ButtonsTransparent" role="tabpanel" aria-labelledby="home-tab">
												<div class="card-body pt-0">
													<button type="button" class="btn tp-btn btn-primary">Primary</button>
													<button type="button" class="btn tp-btn btn-secondary">Secondary</button>
													<button type="button" class="btn tp-btn btn-success">Success</button>
													<button type="button" class="btn tp-btn btn-danger">Danger</button>
													<button type="button" class="btn tp-btn btn-warning">Warning</button>
													<button type="button" class="btn tp-btn btn-info">Info</button>
													<button type="button" class="btn tp-btn btn-light">Light</button>
													<button type="button" class="btn tp-btn btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade" id="ButtonsTransparent-html" role="tabpanel" aria-labelledby="home-tab-16">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn tp-btn btn-primary"&gt;Primary&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-secondary"&gt;Secondary&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-success"&gt;Success&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-danger"&gt;Danger&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-warning"&gt;Warning&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-info"&gt;Info&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-light"&gt;Light&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>

									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="buttons-transparent-light">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
											<h4 class="card-title">Buttons Transparent Light</h4>
											<p class="mb-0 subtitle">Button transparent light style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-17" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-17" data-bs-toggle="tab" data-bs-target="#TransparentLight" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-17" data-bs-toggle="tab" data-bs-target="#TransparentLight-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-17">
											<div class="tab-pane fade show active" id="TransparentLight" role="tabpanel" aria-labelledby="home-tab-17">
												<div class="card-body pt-0">
													<button type="button" class="btn tp-btn-light btn-primary">Primary</button>
													<button type="button" class="btn tp-btn-light btn-secondary">Secondary</button>
													<button type="button" class="btn tp-btn-light btn-success">Success</button>
													<button type="button" class="btn tp-btn-light btn-danger">Danger</button>
													<button type="button" class="btn tp-btn-light btn-warning">Warning</button>
													<button type="button" class="btn tp-btn-light btn-info">Info</button>
													<button type="button" class="btn tp-btn-light btn-light">Light</button>
													<button type="button" class="btn tp-btn-light btn-dark">Dark</button>
												</div>
											</div>
											<div class="tab-pane fade " id="TransparentLight-html" role="tabpanel" aria-labelledby="home-tab-17">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn tp-btn-light btn-primary"&gt;Primary&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-secondary"&gt;Secondary&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-success"&gt;Success&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-danger"&gt;Danger&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-warning"&gt;Warning&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-info"&gt;Info&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-light"&gt;Light&lt;/button&gt;
	&lt;button type="button" class="btn tp-btn-light btn-dark"&gt;Dark&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="disabled-button">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Disabled Button</h4>
												<p class="mb-0 subtitle">add <code>disabled="disabled"</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-18" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-18" data-bs-toggle="tab" data-bs-target="#DisabledButton" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-18" data-bs-toggle="tab" data-bs-target="#DisabledButton-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-18">
											<div class="tab-pane fade show active" id="DisabledButton" role="tabpanel" aria-labelledby="home-tab-18">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-rounded btn-primary" disabled="disabled">Primary</button>
													<button type="button" class="btn btn-rounded btn-secondary" disabled="disabled">Secondary</button>
													<button type="button" class="btn btn-rounded btn-success" disabled="disabled">Success</button>
													<button type="button" class="btn btn-rounded btn-danger" disabled="disabled">Danger</button>
													<button type="button" class="btn btn-rounded btn-warning" disabled="disabled">Warning</button>
													<button type="button" class="btn btn-rounded btn-info" disabled="disabled">Info</button>
												</div>
											</div>
											<div class="tab-pane fade" id="DisabledButton-html" role="tabpanel" aria-labelledby="home-tab-18">
												<div class="card-body p-0 code-area">
<pre class="m-0"><code class="language-html">&lt;button type="button" class="btn btn-rounded btn-primary" disabled="disabled"&gt;Primary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-secondary" disabled="disabled"&gt;Secondary&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-success" disabled="disabled"&gt;Success&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-danger" disabled="disabled"&gt;Danger&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-warning" disabled="disabled"&gt;Warning&lt;/button&gt;
&lt;button type="button" class="btn btn-rounded btn-info" disabled="disabled"&gt;Info&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Column  -->
                                <!-- Column  -->
								<div class="col-lg-12">
									<div class="card dz-card" id="socia-icon-buttons">
										<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
											<div>
												<h4 class="card-title">Socia icon Buttons with Name</h4>
												<p class="mb-0 subtitle">add <code>.btn-facebook, .btn-twitter, .btn-youtube...</code> to change the style</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab-19" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab-19" data-bs-toggle="tab" data-bs-target="#ButtonsName" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab-19" data-bs-toggle="tab" data-bs-target="#ButtonsName-html" type="button" role="tab"  aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<div class="tab-content" id="myTabContent-19">
											<div class="tab-pane fade show active" id="ButtonsName" role="tabpanel" aria-labelledby="home-tab-19">
												<div class="card-body pt-0">
													<button type="button" class="btn btn-facebook">Facebook <span class="btn-icon-end"><i class="fab fa-facebook-f"></i></span>
													</button>
													<button type="button" class="btn btn-twitter">Twitter <span class="btn-icon-end"><i class="fab fa-twitter"></i></span>
													</button>
													<button type="button" class="btn btn-youtube">Youtube <span class="btn-icon-end"><i class="fab fa-youtube"></i></span>
													</button>
													<button type="button" class="btn btn-instagram">Instagram <span
															class="btn-icon-end"><i class="fab fa-instagram"></i></span>
													</button>
													<button type="button" class="btn btn-pinterest">Pinterest <span
															class="btn-icon-end"><i class="fab fa-pinterest-square"></i></span>
													</button>
													<button type="button" class="btn btn-linkedin">Linkedin <span class="btn-icon-end"><i class="fab fa-linkedin-in"></i></span>
													</button>
													<button type="button" class="btn btn-google-plus">Google + <span
															class="btn-icon-end"><i class="fab fa-google-plus-g"></i></span>
													</button>
													<button type="button" class="btn btn-google">Google <span class="btn-icon-end"><i class="fab fa-google"></i></span>
													</button>
													<button type="button" class="btn btn-snapchat">Snapchat <span class="btn-icon-end"><i class="fab fa-snapchat"></i></span>
													</button>
													<button type="button" class="btn btn-whatsapp">Whatsapp <span class="btn-icon-end"><i class="fab fa-whatsapp"></i></span>
													</button>
													<button type="button" class="btn btn-tumblr">Tumblr <span class="btn-icon-end"><i class="fab fa-tumblr"></i></span>
													</button>
													<button type="button" class="btn btn-reddit">Reddit <span class="btn-icon-end"><i class="fab fa-reddit"></i></span>
													</button>
													<button type="button" class="btn btn-spotify">Spotify <span class="btn-icon-end"><i class="fab fa-spotify"></i></span>
													</button>
													<button type="button" class="btn btn-yahoo">Yahoo <span class="btn-icon-end"><i class="fab fa-yahoo"></i></span>
													</button>
													<button type="button" class="btn btn-dribbble">Dribbble <span class="btn-icon-end"><i class="fab fa-dribbble"></i></span>
													</button>
													<button type="button" class="btn btn-skype">Skype <span class="btn-icon-end"><i class="fab fa-skype"></i></span>
													</button>
													<button type="button" class="btn btn-quora">Quora <span class="btn-icon-end"><i class="fab fa-quora"></i></span>
													</button>
													<button type="button" class="btn btn-vimeo">Vimeo <span class="btn-icon-end"><i class="fab fa-vimeo-v"></i></span>
													</button>
												</div>
											</div>
											<div class="tab-pane fade" id="ButtonsName-html" role="tabpanel" aria-labelledby="home-tab-19">
												<div class="card-body p-0 code-area">
<pre class="m-0"> <code class="language-html">&lt;button type="button" class="btn btn-facebook"&gt;Facebook &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-facebook-f"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-twitter"&gt;Twitter &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-twitter"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-youtube"&gt;Youtube &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-youtube"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-instagram"&gt;Instagram &lt;span
		class="btn-icon-end"&gt;&lt;i class="fab fa-instagram"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-pinterest"&gt;Pinterest &lt;span
		class="btn-icon-end"&gt;&lt;i class="fab fa-pinterest-square"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-linkedin"&gt;Linkedin &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-linkedin-in"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-google-plus"&gt;Google + &lt;span
		class="btn-icon-end"&gt;&lt;i class="fab fa-google-plus-g"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-google"&gt;Google &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-google"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-snapchat"&gt;Snapchat &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-snapchat"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-whatsapp"&gt;Whatsapp &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-whatsapp"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-tumblr"&gt;Tumblr &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-tumblr"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-reddit"&gt;Reddit &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-reddit"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-spotify"&gt;Spotify &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-spotify"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-yahoo"&gt;Yahoo &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-yahoo"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-dribbble"&gt;Dribbble &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-dribbble"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-skype"&gt;Skype &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-skype"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-quora"&gt;Quora &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-quora"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;
&lt;button type="button" class="btn btn-vimeo"&gt;Vimeo &lt;span class="btn-icon-end"&gt;&lt;i class="fab fa-vimeo-v"&gt;&lt;/i&gt;&lt;/span&gt;
&lt;/button&gt;</code></pre>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="demo-right ">
                        <div class="demo-right-inner dz-scroll " id="right-sidebar">
                            <h4 class="title">Buttom</h4>
							<div class="dz-scroll demo-right-tabs" id="rightSidebarScroll">
								<ul class="navbar-nav" id="menu-bar">
									<li><a href="#default-button" class="scroll">Default Button</a></li>
									<li><a href="#buttons-with-icon" class="scroll">Buttons With Icon</a></li>
									<li><a href="#button-light" class="scroll">Button Light</a></li>
									<li><a href="#default-outline-button" class="scroll">Default Outline Button</a></li>
									<li><a href="#button-sizes" class="scroll">Button Sizes</a></li>
									<li><a href="#button-sizes-icon" class="scroll">Button Sizes icon</a></li>
									<li><a href="#outline-button-sizes" class="scroll">Outline Button Sizes</a></li>
									<li><a href="#rounded-buttons" class="scroll">Rounded Buttons</a></li>
									<li><a href="#rounded-outline-buttons" class="scroll">Rounded Outline Buttons</a></li>
									<li><a href="#button-right-icons" class="scroll">Button Right Icons</a></li>
									<li><a href="#button-left-icons" class="scroll">Button Left Icons</a></li>
									<li><a href="#square-buttons" class="scroll">Square Buttons</a></li>
									<li><a href="#square-outline-buttons" class="scroll">Square Outline Buttons</a></li>
									<li><a href="#rounded-button" class="scroll">Rounded Button</a></li>
									<li><a href="#rounded-outline-buttons" class="scroll">Rounded Outline Buttons</a></li>
									<li><a href="#buttons-transparent-light" class="scroll">Buttons Transparent Light</a></li>
									<li><a href="#buttons-transparent" class="scroll">Buttons Transparent</a></li>
									<li><a href="#disabled-button" class="scroll">Disabled Button</a></li>
									<li><a href="#socia-icon-buttons" class="scroll">Socia icon Buttons with Name</a></li>
								</ul>
							</div>
                        </div>
                    </div>
				</div>
				<!--/element-area-->

            </div>
    @endsection
    @push('scripts')
    <script>
        hljs.highlightAll();
	    hljs.configure({ ignoreUnescapedHTML: true })

		document.addEventListener('DOMContentLoaded', (event) => {
			document.querySelectorAll('pre code').forEach((el) => {
				hljs.highlightElement(el);
			});
		});
	</script>
    @endpush
