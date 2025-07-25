@extends('layouts.default')
@section('content')
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="javascript:void(0)">Bootstrap</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
            <!-- container starts -->
            <div class="container-fluid">

                <!-- row -->
				<div class="element-area">
					<div class="demo-view">
						<div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">
							<div class="row">
								<!-- Column starts -->
								<div class="col-xl-12">
									<div class="card dz-card" id="accordion-one">
										<div class="card-header flex-wrap">
											<div>
												<h4 class="card-title">Basic Datatable</h4>
												<p class="m-0 subtitle">Default datatables. Add <code>datatables</code> class in root</p>
											</div>
											<ul class="nav nav-tabs dzm-tabs" id="myTab" role="tablist">
												<li class="nav-item" role="presentation">
													<button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#Preview" type="button" role="tab"  aria-selected="true">Preview</button>
												</li>
												<li class="nav-item" role="presentation">
													<button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#html" type="button" role="tab" aria-controls="html" aria-selected="false">HTML</button>
												</li>
											</ul>
										</div>
										<!--tab-content-->
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
														<thead>
															<tr>
																<th>Name</th>
																<th>Position</th>
																<th>Office</th>
																<th>Age</th>
																<th>Start date</th>
																<th>Salary</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>Tiger Nixon</td>
																<td>System Architect</td>
																<td>Edinburgh</td>
																<td>61</td>
																<td>2011/04/25</td>
																<td>$320,800</td>
															</tr>
															<tr>
																<td>Garrett Winters</td>
																<td>Accountant</td>
																<td>Tokyo</td>
																<td>63</td>
																<td>2011/07/25</td>
																<td>$170,750</td>
															</tr>
															<tr>
																<td>Ashton Cox</td>
																<td>Junior Technical Author</td>
																<td>San Francisco</td>
																<td>66</td>
																<td>2009/01/12</td>
																<td>$86,000</td>
															</tr>
															<tr>
																<td>Cedric Kelly</td>
																<td>Senior Javascript Developer</td>
																<td>Edinburgh</td>
																<td>22</td>
																<td>2012/03/29</td>
																<td>$433,060</td>
															</tr>
															<tr>
																<td>Airi Satou</td>
																<td>Accountant</td>
																<td>Tokyo</td>
																<td>33</td>
																<td>2008/11/28</td>
																<td>$162,700</td>
															</tr>
															<tr>
																<td>Brielle Williamson</td>
																<td>Integration Specialist</td>
																<td>New York</td>
																<td>61</td>
																<td>2012/12/02</td>
																<td>$372,000</td>
															</tr>
															<tr>
																<td>Herrod Chandler</td>
																<td>Sales Assistant</td>
																<td>San Francisco</td>
																<td>59</td>
																<td>2012/08/06</td>
																<td>$137,500</td>
															</tr>
															<tr>
																<td>Rhona Davidson</td>
																<td>Integration Specialist</td>
																<td>Tokyo</td>
																<td>55</td>
																<td>2010/10/14</td>
																<td>$327,900</td>
															</tr>
															<tr>
																<td>Colleen Hurst</td>
																<td>Javascript Developer</td>
																<td>San Francisco</td>
																<td>39</td>
																<td>2009/09/15</td>
																<td>$205,500</td>
															</tr>
															<tr>
																<td>Sonya Frost</td>
																<td>Software Engineer</td>
																<td>Edinburgh</td>
																<td>23</td>
																<td>2008/12/13</td>
																<td>$103,600</td>
															</tr>
															<tr>
																<td>Jena Gaines</td>
																<td>Office Manager</td>
																<td>London</td>
																<td>30</td>
																<td>2008/12/19</td>
																<td>$90,560</td>
															</tr>
															<tr>
																<td>Quinn Flynn</td>
																<td>Support Lead</td>
																<td>Edinburgh</td>
																<td>22</td>
																<td>2013/03/03</td>
																<td>$342,000</td>
															</tr>
															<tr>
																<td>Charde Marshall</td>
																<td>Regional Director</td>
																<td>San Francisco</td>
																<td>36</td>
																<td>2008/10/16</td>
																<td>$470,600</td>
															</tr>
															<tr>
																<td>Haley Kennedy</td>
																<td>Senior Marketing Designer</td>
																<td>London</td>
																<td>43</td>
																<td>2012/12/18</td>
																<td>$313,500</td>
															</tr>
															<tr>
																<td>Tatyana Fitzpatrick</td>
																<td>Regional Director</td>
																<td>London</td>
																<td>19</td>
																<td>2010/03/17</td>
																<td>$385,750</td>
															</tr>
															<tr>
																<td>Michael Silva</td>
																<td>Marketing Designer</td>
																<td>London</td>
																<td>66</td>
																<td>2012/11/27</td>
																<td>$198,500</td>
															</tr>
															<tr>
																<td>Paul Byrd</td>
																<td>Chief Financial Officer (CFO)</td>
																<td>New York</td>
																<td>64</td>
																<td>2010/06/09</td>
																<td>$725,000</td>
															</tr>
															<tr>
																<td>Gloria Little</td>
																<td>Systems Administrator</td>
																<td>New York</td>
																<td>59</td>
																<td>2009/04/10</td>
																<td>$237,500</td>
															</tr>
															<tr>
																<td>Bradley Greer</td>
																<td>Software Engineer</td>
																<td>London</td>
																<td>41</td>
																<td>2012/10/13</td>
																<td>$132,000</td>
															</tr>
															<tr>
																<td>Dai Rios</td>
																<td>Personnel Lead</td>
																<td>Edinburgh</td>
																<td>35</td>
																<td>2012/09/26</td>
																<td>$217,500</td>
															</tr>
															<tr>
																<td>Jenette Caldwell</td>
																<td>Development Lead</td>
																<td>New York</td>
																<td>30</td>
																<td>2011/09/03</td>
																<td>$345,000</td>
															</tr>
															<tr>
																<td>Yuri Berry</td>
																<td>Chief Marketing Officer (CMO)</td>
																<td>New York</td>
																<td>40</td>
																<td>2009/06/25</td>
																<td>$675,000</td>
															</tr>
															<tr>
																<td>Caesar Vance</td>
																<td>Pre-Sales Support</td>
																<td>New York</td>
																<td>21</td>
																<td>2011/12/12</td>
																<td>$106,450</td>
															</tr>
															<tr>
																<td>Doris Wilder</td>
																<td>Sales Assistant</td>
																<td>Sidney</td>
																<td>23</td>
																<td>2010/09/20</td>
																<td>$85,600</td>
															</tr>
															<tr>
																<td>Angelica Ramos</td>
																<td>Chief Executive Officer (CEO)</td>
																<td>London</td>
																<td>47</td>
																<td>2009/10/09</td>
																<td>$1,200,000</td>
															</tr>
															<tr>
																<td>Gavin Joyce</td>
																<td>Developer</td>
																<td>Edinburgh</td>
																<td>42</td>
																<td>2010/12/22</td>
																<td>$92,575</td>
															</tr>
															<tr>
																<td>Jennifer Chang</td>
																<td>Regional Director</td>
																<td>Singapore</td>
																<td>28</td>
																<td>2010/11/14</td>
																<td>$357,650</td>
															</tr>
															<tr>
																<td>Brenden Wagner</td>
																<td>Software Engineer</td>
																<td>San Francisco</td>
																<td>28</td>
																<td>2011/06/07</td>
																<td>$206,850</td>
															</tr>
															<tr>
																<td>Fiona Green</td>
																<td>Chief Operating Officer (COO)</td>
																<td>San Francisco</td>
																<td>48</td>
																<td>2010/03/11</td>
																<td>$850,000</td>
															</tr>
															<tr>
																<td>Shou Itou</td>
																<td>Regional Marketing</td>
																<td>Tokyo</td>
																<td>20</td>
																<td>2011/08/14</td>
																<td>$163,000</td>
															</tr>
															<tr>
																<td>Michelle House</td>
																<td>Integration Specialist</td>
																<td>Sidney</td>
																<td>37</td>
																<td>2011/06/02</td>
																<td>$95,400</td>
															</tr>
															<tr>
																<td>Suki Burks</td>
																<td>Developer</td>
																<td>London</td>
																<td>53</td>
																<td>2009/10/22</td>
																<td>$114,500</td>
															</tr>
															<tr>
																<td>Prescott Bartlett</td>
																<td>Technical Author</td>
																<td>London</td>
																<td>27</td>
																<td>2011/05/07</td>
																<td>$145,000</td>
															</tr>
															<tr>
																<td>Gavin Cortez</td>
																<td>Team Leader</td>
																<td>San Francisco</td>
																<td>22</td>
																<td>2008/10/26</td>
																<td>$235,500</td>
															</tr>
															<tr>
																<td>Martena Mccray</td>
																<td>Post-Sales support</td>
																<td>Edinburgh</td>
																<td>46</td>
																<td>2011/03/09</td>
																<td>$324,050</td>
															</tr>
															<tr>
																<td>Unity Butler</td>
																<td>Marketing Designer</td>
																<td>San Francisco</td>
																<td>47</td>
																<td>2009/12/09</td>
																<td>$85,675</td>
															</tr>
															<tr>
																<td>Howard Hatfield</td>
																<td>Office Manager</td>
																<td>San Francisco</td>
																<td>51</td>
																<td>2008/12/16</td>
																<td>$164,500</td>
															</tr>
															<tr>
																<td>Hope Fuentes</td>
																<td>Secretary</td>
																<td>San Francisco</td>
																<td>41</td>
																<td>2010/02/12</td>
																<td>$109,850</td>
															</tr>
															<tr>
																<td>Vivian Harrell</td>
																<td>Financial Controller</td>
																<td>San Francisco</td>
																<td>62</td>
																<td>2009/02/14</td>
																<td>$452,500</td>
															</tr>
															<tr>
																<td>Timothy Mooney</td>
																<td>Office Manager</td>
																<td>London</td>
																<td>37</td>
																<td>2008/12/11</td>
																<td>$136,200</td>
															</tr>
															<tr>
																<td>Jackson Bradshaw</td>
																<td>Director</td>
																<td>New York</td>
																<td>65</td>
																<td>2008/09/26</td>
																<td>$645,750</td>
															</tr>
															<tr>
																<td>Olivia Liang</td>
																<td>Support Engineer</td>
																<td>Singapore</td>
																<td>64</td>
																<td>2011/02/03</td>
																<td>$234,500</td>
															</tr>
															<tr>
																<td>Bruno Nash</td>
																<td>Software Engineer</td>
																<td>London</td>
																<td>38</td>
																<td>2011/05/03</td>
																<td>$163,500</td>
															</tr>
															<tr>
																<td>Sakura Yamamoto</td>
																<td>Support Engineer</td>
																<td>Tokyo</td>
																<td>37</td>
																<td>2009/08/19</td>
																<td>$139,575</td>
															</tr>
															<tr>
																<td>Thor Walton</td>
																<td>Developer</td>
																<td>New York</td>
																<td>61</td>
																<td>2013/08/11</td>
																<td>$98,540</td>
															</tr>
															<tr>
																<td>Finn Camacho</td>
																<td>Support Engineer</td>
																<td>San Francisco</td>
																<td>47</td>
																<td>2009/07/07</td>
																<td>$87,500</td>
															</tr>
															<tr>
																<td>Serge Baldwin</td>
																<td>Data Coordinator</td>
																<td>Singapore</td>
																<td>64</td>
																<td>2012/04/09</td>
																<td>$138,575</td>
															</tr>
															<tr>
																<td>Zenaida Frank</td>
																<td>Software Engineer</td>
																<td>New York</td>
																<td>63</td>
																<td>2010/01/04</td>
																<td>$125,250</td>
															</tr>
															<tr>
																<td>Zorita Serrano</td>
																<td>Software Engineer</td>
																<td>San Francisco</td>
																<td>56</td>
																<td>2012/06/01</td>
																<td>$115,000</td>
															</tr>
															<tr>
																<td>Jennifer Acosta</td>
																<td>Junior Javascript Developer</td>
																<td>Edinburgh</td>
																<td>43</td>
																<td>2013/02/01</td>
																<td>$75,650</td>
															</tr>
															<tr>
																<td>Cara Stevens</td>
																<td>Sales Assistant</td>
																<td>New York</td>
																<td>46</td>
																<td>2011/12/06</td>
																<td>$145,600</td>
															</tr>
															<tr>
																<td>Hermione Butler</td>
																<td>Regional Director</td>
																<td>London</td>
																<td>47</td>
																<td>2011/03/21</td>
																<td>$356,250</td>
															</tr>
															<tr>
																<td>Lael Greer</td>
																<td>Systems Administrator</td>
																<td>London</td>
																<td>21</td>
																<td>2009/02/27</td>
																<td>$103,500</td>
															</tr>
															<tr>
																<td>Jonas Alexander</td>
																<td>Developer</td>
																<td>San Francisco</td>
																<td>30</td>
																<td>2010/07/14</td>
																<td>$86,500</td>
															</tr>
															<tr>
																<td>Shad Decker</td>
																<td>Regional Director</td>
																<td>Edinburgh</td>
																<td>51</td>
																<td>2008/11/13</td>
																<td>$183,000</td>
															</tr>
															<tr>
																<td>Michael Bruce</td>
																<td>Javascript Developer</td>
																<td>Singapore</td>
																<td>29</td>
																<td>2011/06/27</td>
																<td>$183,000</td>
															</tr>
															<tr>
																<td>Donna Snider</td>
																<td>Customer Support</td>
																<td>New York</td>
																<td>27</td>
																<td>2011/01/25</td>
																<td>$112,000</td>
															</tr>
														</tbody>
														<tfoot>
															<tr>
																<th>Name</th>
																<th>Position</th>
																<th>Office</th>
																<th>Age</th>
																<th>Start date</th>
																<th>Salary</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
												<!-- /Default accordion -->
											</div>
											<div class="tab-pane fade " id="html" role="tabpanel" aria-labelledby="home-tab">
												<div class="card-body pt-0 p-0 code-area">
<!-- Default accordion -->
<pre class="mb-0"><code class="language-html">
 &lt;div class="table-responsive"&gt;
	&lt;table id="example" class="display table" style="min-width: 845px"&gt;
		&lt;thead&gt;
			&lt;tr&gt;
				&lt;th&gt;Name&lt;/th&gt;
				&lt;th&gt;Position&lt;/th&gt;
				&lt;th&gt;Office&lt;/th&gt;
				&lt;th&gt;Age&lt;/th&gt;
				&lt;th&gt;Start date&lt;/th&gt;
				&lt;th&gt;Salary&lt;/th&gt;
			&lt;/tr&gt;
		&lt;/thead&gt;
		&lt;tbody&gt;
			&lt;tr&gt;
				&lt;td&gt;Tiger Nixon&lt;/td&gt;
				&lt;td&gt;System Architect&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;61&lt;/td&gt;
				&lt;td&gt;2011/04/25&lt;/td&gt;
				&lt;td&gt;$320,800&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Garrett Winters&lt;/td&gt;
				&lt;td&gt;Accountant&lt;/td&gt;
				&lt;td&gt;Tokyo&lt;/td&gt;
				&lt;td&gt;63&lt;/td&gt;
				&lt;td&gt;2011/07/25&lt;/td&gt;
				&lt;td&gt;$170,750&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Ashton Cox&lt;/td&gt;
				&lt;td&gt;Junior Technical Author&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;66&lt;/td&gt;
				&lt;td&gt;2009/01/12&lt;/td&gt;
				&lt;td&gt;$86,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Cedric Kelly&lt;/td&gt;
				&lt;td&gt;Senior Javascript Developer&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;22&lt;/td&gt;
				&lt;td&gt;2012/03/29&lt;/td&gt;
				&lt;td&gt;$433,060&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Airi Satou&lt;/td&gt;
				&lt;td&gt;Accountant&lt;/td&gt;
				&lt;td&gt;Tokyo&lt;/td&gt;
				&lt;td&gt;33&lt;/td&gt;
				&lt;td&gt;2008/11/28&lt;/td&gt;
				&lt;td&gt;$162,700&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Brielle Williamson&lt;/td&gt;
				&lt;td&gt;Integration Specialist&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;61&lt;/td&gt;
				&lt;td&gt;2012/12/02&lt;/td&gt;
				&lt;td&gt;$372,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Herrod Chandler&lt;/td&gt;
				&lt;td&gt;Sales Assistant&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;59&lt;/td&gt;
				&lt;td&gt;2012/08/06&lt;/td&gt;
				&lt;td&gt;$137,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Rhona Davidson&lt;/td&gt;
				&lt;td&gt;Integration Specialist&lt;/td&gt;
				&lt;td&gt;Tokyo&lt;/td&gt;
				&lt;td&gt;55&lt;/td&gt;
				&lt;td&gt;2010/10/14&lt;/td&gt;
				&lt;td&gt;$327,900&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Colleen Hurst&lt;/td&gt;
				&lt;td&gt;Javascript Developer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;39&lt;/td&gt;
				&lt;td&gt;2009/09/15&lt;/td&gt;
				&lt;td&gt;$205,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Sonya Frost&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;23&lt;/td&gt;
				&lt;td&gt;2008/12/13&lt;/td&gt;
				&lt;td&gt;$103,600&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jena Gaines&lt;/td&gt;
				&lt;td&gt;Office Manager&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;30&lt;/td&gt;
				&lt;td&gt;2008/12/19&lt;/td&gt;
				&lt;td&gt;$90,560&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Quinn Flynn&lt;/td&gt;
				&lt;td&gt;Support Lead&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;22&lt;/td&gt;
				&lt;td&gt;2013/03/03&lt;/td&gt;
				&lt;td&gt;$342,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Charde Marshall&lt;/td&gt;
				&lt;td&gt;Regional Director&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;36&lt;/td&gt;
				&lt;td&gt;2008/10/16&lt;/td&gt;
				&lt;td&gt;$470,600&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Haley Kennedy&lt;/td&gt;
				&lt;td&gt;Senior Marketing Designer&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;43&lt;/td&gt;
				&lt;td&gt;2012/12/18&lt;/td&gt;
				&lt;td&gt;$313,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Tatyana Fitzpatrick&lt;/td&gt;
				&lt;td&gt;Regional Director&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;19&lt;/td&gt;
				&lt;td&gt;2010/03/17&lt;/td&gt;
				&lt;td&gt;$385,750&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Michael Silva&lt;/td&gt;
				&lt;td&gt;Marketing Designer&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;66&lt;/td&gt;
				&lt;td&gt;2012/11/27&lt;/td&gt;
				&lt;td&gt;$198,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Paul Byrd&lt;/td&gt;
				&lt;td&gt;Chief Financial Officer (CFO)&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;64&lt;/td&gt;
				&lt;td&gt;2010/06/09&lt;/td&gt;
				&lt;td&gt;$725,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Gloria Little&lt;/td&gt;
				&lt;td&gt;Systems Administrator&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;59&lt;/td&gt;
				&lt;td&gt;2009/04/10&lt;/td&gt;
				&lt;td&gt;$237,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Bradley Greer&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;41&lt;/td&gt;
				&lt;td&gt;2012/10/13&lt;/td&gt;
				&lt;td&gt;$132,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Dai Rios&lt;/td&gt;
				&lt;td&gt;Personnel Lead&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;35&lt;/td&gt;
				&lt;td&gt;2012/09/26&lt;/td&gt;
				&lt;td&gt;$217,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jenette Caldwell&lt;/td&gt;
				&lt;td&gt;Development Lead&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;30&lt;/td&gt;
				&lt;td&gt;2011/09/03&lt;/td&gt;
				&lt;td&gt;$345,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Yuri Berry&lt;/td&gt;
				&lt;td&gt;Chief Marketing Officer (CMO)&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;40&lt;/td&gt;
				&lt;td&gt;2009/06/25&lt;/td&gt;
				&lt;td&gt;$675,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Caesar Vance&lt;/td&gt;
				&lt;td&gt;Pre-Sales Support&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;21&lt;/td&gt;
				&lt;td&gt;2011/12/12&lt;/td&gt;
				&lt;td&gt;$106,450&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Doris Wilder&lt;/td&gt;
				&lt;td&gt;Sales Assistant&lt;/td&gt;
				&lt;td&gt;Sidney&lt;/td&gt;
				&lt;td&gt;23&lt;/td&gt;
				&lt;td&gt;2010/09/20&lt;/td&gt;
				&lt;td&gt;$85,600&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Angelica Ramos&lt;/td&gt;
				&lt;td&gt;Chief Executive Officer (CEO)&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;47&lt;/td&gt;
				&lt;td&gt;2009/10/09&lt;/td&gt;
				&lt;td&gt;$1,200,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Gavin Joyce&lt;/td&gt;
				&lt;td&gt;Developer&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;42&lt;/td&gt;
				&lt;td&gt;2010/12/22&lt;/td&gt;
				&lt;td&gt;$92,575&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jennifer Chang&lt;/td&gt;
				&lt;td&gt;Regional Director&lt;/td&gt;
				&lt;td&gt;Singapore&lt;/td&gt;
				&lt;td&gt;28&lt;/td&gt;
				&lt;td&gt;2010/11/14&lt;/td&gt;
				&lt;td&gt;$357,650&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Brenden Wagner&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;28&lt;/td&gt;
				&lt;td&gt;2011/06/07&lt;/td&gt;
				&lt;td&gt;$206,850&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Fiona Green&lt;/td&gt;
				&lt;td&gt;Chief Operating Officer (COO)&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;48&lt;/td&gt;
				&lt;td&gt;2010/03/11&lt;/td&gt;
				&lt;td&gt;$850,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Shou Itou&lt;/td&gt;
				&lt;td&gt;Regional Marketing&lt;/td&gt;
				&lt;td&gt;Tokyo&lt;/td&gt;
				&lt;td&gt;20&lt;/td&gt;
				&lt;td&gt;2011/08/14&lt;/td&gt;
				&lt;td&gt;$163,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Michelle House&lt;/td&gt;
				&lt;td&gt;Integration Specialist&lt;/td&gt;
				&lt;td&gt;Sidney&lt;/td&gt;
				&lt;td&gt;37&lt;/td&gt;
				&lt;td&gt;2011/06/02&lt;/td&gt;
				&lt;td&gt;$95,400&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Suki Burks&lt;/td&gt;
				&lt;td&gt;Developer&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;53&lt;/td&gt;
				&lt;td&gt;2009/10/22&lt;/td&gt;
				&lt;td&gt;$114,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Prescott Bartlett&lt;/td&gt;
				&lt;td&gt;Technical Author&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;27&lt;/td&gt;
				&lt;td&gt;2011/05/07&lt;/td&gt;
				&lt;td&gt;$145,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Gavin Cortez&lt;/td&gt;
				&lt;td&gt;Team Leader&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;22&lt;/td&gt;
				&lt;td&gt;2008/10/26&lt;/td&gt;
				&lt;td&gt;$235,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Martena Mccray&lt;/td&gt;
				&lt;td&gt;Post-Sales support&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;46&lt;/td&gt;
				&lt;td&gt;2011/03/09&lt;/td&gt;
				&lt;td&gt;$324,050&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Unity Butler&lt;/td&gt;
				&lt;td&gt;Marketing Designer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;47&lt;/td&gt;
				&lt;td&gt;2009/12/09&lt;/td&gt;
				&lt;td&gt;$85,675&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Howard Hatfield&lt;/td&gt;
				&lt;td&gt;Office Manager&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;51&lt;/td&gt;
				&lt;td&gt;2008/12/16&lt;/td&gt;
				&lt;td&gt;$164,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Hope Fuentes&lt;/td&gt;
				&lt;td&gt;Secretary&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;41&lt;/td&gt;
				&lt;td&gt;2010/02/12&lt;/td&gt;
				&lt;td&gt;$109,850&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Vivian Harrell&lt;/td&gt;
				&lt;td&gt;Financial Controller&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;62&lt;/td&gt;
				&lt;td&gt;2009/02/14&lt;/td&gt;
				&lt;td&gt;$452,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Timothy Mooney&lt;/td&gt;
				&lt;td&gt;Office Manager&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;37&lt;/td&gt;
				&lt;td&gt;2008/12/11&lt;/td&gt;
				&lt;td&gt;$136,200&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jackson Bradshaw&lt;/td&gt;
				&lt;td&gt;Director&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;65&lt;/td&gt;
				&lt;td&gt;2008/09/26&lt;/td&gt;
				&lt;td&gt;$645,750&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Olivia Liang&lt;/td&gt;
				&lt;td&gt;Support Engineer&lt;/td&gt;
				&lt;td&gt;Singapore&lt;/td&gt;
				&lt;td&gt;64&lt;/td&gt;
				&lt;td&gt;2011/02/03&lt;/td&gt;
				&lt;td&gt;$234,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Bruno Nash&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;38&lt;/td&gt;
				&lt;td&gt;2011/05/03&lt;/td&gt;
				&lt;td&gt;$163,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Sakura Yamamoto&lt;/td&gt;
				&lt;td&gt;Support Engineer&lt;/td&gt;
				&lt;td&gt;Tokyo&lt;/td&gt;
				&lt;td&gt;37&lt;/td&gt;
				&lt;td&gt;2009/08/19&lt;/td&gt;
				&lt;td&gt;$139,575&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Thor Walton&lt;/td&gt;
				&lt;td&gt;Developer&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;61&lt;/td&gt;
				&lt;td&gt;2013/08/11&lt;/td&gt;
				&lt;td&gt;$98,540&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Finn Camacho&lt;/td&gt;
				&lt;td&gt;Support Engineer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;47&lt;/td&gt;
				&lt;td&gt;2009/07/07&lt;/td&gt;
				&lt;td&gt;$87,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Serge Baldwin&lt;/td&gt;
				&lt;td&gt;Data Coordinator&lt;/td&gt;
				&lt;td&gt;Singapore&lt;/td&gt;
				&lt;td&gt;64&lt;/td&gt;
				&lt;td&gt;2012/04/09&lt;/td&gt;
				&lt;td&gt;$138,575&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Zenaida Frank&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;63&lt;/td&gt;
				&lt;td&gt;2010/01/04&lt;/td&gt;
				&lt;td&gt;$125,250&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Zorita Serrano&lt;/td&gt;
				&lt;td&gt;Software Engineer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;56&lt;/td&gt;
				&lt;td&gt;2012/06/01&lt;/td&gt;
				&lt;td&gt;$115,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jennifer Acosta&lt;/td&gt;
				&lt;td&gt;Junior Javascript Developer&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;43&lt;/td&gt;
				&lt;td&gt;2013/02/01&lt;/td&gt;
				&lt;td&gt;$75,650&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Cara Stevens&lt;/td&gt;
				&lt;td&gt;Sales Assistant&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;46&lt;/td&gt;
				&lt;td&gt;2011/12/06&lt;/td&gt;
				&lt;td&gt;$145,600&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Hermione Butler&lt;/td&gt;
				&lt;td&gt;Regional Director&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;47&lt;/td&gt;
				&lt;td&gt;2011/03/21&lt;/td&gt;
				&lt;td&gt;$356,250&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Lael Greer&lt;/td&gt;
				&lt;td&gt;Systems Administrator&lt;/td&gt;
				&lt;td&gt;London&lt;/td&gt;
				&lt;td&gt;21&lt;/td&gt;
				&lt;td&gt;2009/02/27&lt;/td&gt;
				&lt;td&gt;$103,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Jonas Alexander&lt;/td&gt;
				&lt;td&gt;Developer&lt;/td&gt;
				&lt;td&gt;San Francisco&lt;/td&gt;
				&lt;td&gt;30&lt;/td&gt;
				&lt;td&gt;2010/07/14&lt;/td&gt;
				&lt;td&gt;$86,500&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Shad Decker&lt;/td&gt;
				&lt;td&gt;Regional Director&lt;/td&gt;
				&lt;td&gt;Edinburgh&lt;/td&gt;
				&lt;td&gt;51&lt;/td&gt;
				&lt;td&gt;2008/11/13&lt;/td&gt;
				&lt;td&gt;$183,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Michael Bruce&lt;/td&gt;
				&lt;td&gt;Javascript Developer&lt;/td&gt;
				&lt;td&gt;Singapore&lt;/td&gt;
				&lt;td&gt;29&lt;/td&gt;
				&lt;td&gt;2011/06/27&lt;/td&gt;
				&lt;td&gt;$183,000&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;Donna Snider&lt;/td&gt;
				&lt;td&gt;Customer Support&lt;/td&gt;
				&lt;td&gt;New York&lt;/td&gt;
				&lt;td&gt;27&lt;/td&gt;
				&lt;td&gt;2011/01/25&lt;/td&gt;
				&lt;td&gt;$112,000&lt;/td&gt;
			&lt;/tr&gt;
		&lt;/tbody&gt;
		&lt;tfoot&gt;
			&lt;tr&gt;
				&lt;th&gt;Name&lt;/th&gt;
				&lt;th&gt;Position&lt;/th&gt;
				&lt;th&gt;Office&lt;/th&gt;
				&lt;th&gt;Age&lt;/th&gt;
				&lt;th&gt;Start date&lt;/th&gt;
				&lt;th&gt;Salary&lt;/th&gt;
			&lt;/tr&gt;
		&lt;/tfoot&gt;
	&lt;/table&gt;
&lt;/div&gt;
</code></pre>
</div>
<!-- /Default accordion -->
											</div>
										</div>
										<!--/tab-content-->
									</div>
								</div>
							</div>
						<!-- Column ends -->
						<!-- Column starts -->
						<div class="col-xl-12">
							<div class="card dz-card" id="accordion-two">
								<div class="card-header flex-wrap d-flex justify-content-between">
									<div>
										<h4 class="card-title">Datatable</h4>
										<p class="m-0 subtitle">datatables with border. Add class <code>datatables-bordered</code> with the class <code> datatables</code></p>
									</div>
									<ul class="nav nav-tabs dzm-tabs" id="myTab-1" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active " id="home-tab-1" data-bs-toggle="tab" data-bs-target="#bordered" type="button" role="tab" aria-selected="true">Preview</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link " id="profile-tab-1" data-bs-toggle="tab" data-bs-target="#bordered-html" type="button" role="tab"  aria-selected="false">HTML</button>
										</li>
									</ul>
								</div>

									<!-- tab-content -->
								<div class="tab-content" id="myTabContent-1">
									<div class="tab-pane fade show active" id="bordered" role="tabpanel" aria-labelledby="home-tab-1">
										<div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                            </tr>
                                            <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                            </tr>
                                            <tr>
                                                <td>Airi Satou</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>33</td>
                                                <td>2008/11/28</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr>
                                                <td>Brielle Williamson</td>
                                                <td>Integration Specialist</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2012/12/02</td>
                                                <td>$372,000</td>
                                            </tr>
                                            <tr>
                                                <td>Herrod Chandler</td>
                                                <td>Sales Assistant</td>
                                                <td>San Francisco</td>
                                                <td>59</td>
                                                <td>2012/08/06</td>
                                                <td>$137,500</td>
                                            </tr>
                                            <tr>
                                                <td>Rhona Davidson</td>
                                                <td>Integration Specialist</td>
                                                <td>Tokyo</td>
                                                <td>55</td>
                                                <td>2010/10/14</td>
                                                <td>$327,900</td>
                                            </tr>
                                            <tr>
                                                <td>Colleen Hurst</td>
                                                <td>Javascript Developer</td>
                                                <td>San Francisco</td>
                                                <td>39</td>
                                                <td>2009/09/15</td>
                                                <td>$205,500</td>
                                            </tr>
                                            <tr>
                                                <td>Sonya Frost</td>
                                                <td>Software Engineer</td>
                                                <td>Edinburgh</td>
                                                <td>23</td>
                                                <td>2008/12/13</td>
                                                <td>$103,600</td>
                                            </tr>
                                            <tr>
                                                <td>Jena Gaines</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>30</td>
                                                <td>2008/12/19</td>
                                                <td>$90,560</td>
                                            </tr>
                                            <tr>
                                                <td>Quinn Flynn</td>
                                                <td>Support Lead</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2013/03/03</td>
                                                <td>$342,000</td>
                                            </tr>
                                            <tr>
                                                <td>Charde Marshall</td>
                                                <td>Regional Director</td>
                                                <td>San Francisco</td>
                                                <td>36</td>
                                                <td>2008/10/16</td>
                                                <td>$470,600</td>
                                            </tr>
                                            <tr>
                                                <td>Haley Kennedy</td>
                                                <td>Senior Marketing Designer</td>
                                                <td>London</td>
                                                <td>43</td>
                                                <td>2012/12/18</td>
                                                <td>$313,500</td>
                                            </tr>
                                            <tr>
                                                <td>Tatyana Fitzpatrick</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>19</td>
                                                <td>2010/03/17</td>
                                                <td>$385,750</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Silva</td>
                                                <td>Marketing Designer</td>
                                                <td>London</td>
                                                <td>66</td>
                                                <td>2012/11/27</td>
                                                <td>$198,500</td>
                                            </tr>
                                            <tr>
                                                <td>Paul Byrd</td>
                                                <td>Chief Financial Officer (CFO)</td>
                                                <td>New York</td>
                                                <td>64</td>
                                                <td>2010/06/09</td>
                                                <td>$725,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gloria Little</td>
                                                <td>Systems Administrator</td>
                                                <td>New York</td>
                                                <td>59</td>
                                                <td>2009/04/10</td>
                                                <td>$237,500</td>
                                            </tr>
                                            <tr>
                                                <td>Bradley Greer</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>41</td>
                                                <td>2012/10/13</td>
                                                <td>$132,000</td>
                                            </tr>
                                            <tr>
                                                <td>Dai Rios</td>
                                                <td>Personnel Lead</td>
                                                <td>Edinburgh</td>
                                                <td>35</td>
                                                <td>2012/09/26</td>
                                                <td>$217,500</td>
                                            </tr>
                                            <tr>
                                                <td>Jenette Caldwell</td>
                                                <td>Development Lead</td>
                                                <td>New York</td>
                                                <td>30</td>
                                                <td>2011/09/03</td>
                                                <td>$345,000</td>
                                            </tr>
                                            <tr>
                                                <td>Yuri Berry</td>
                                                <td>Chief Marketing Officer (CMO)</td>
                                                <td>New York</td>
                                                <td>40</td>
                                                <td>2009/06/25</td>
                                                <td>$675,000</td>
                                            </tr>
                                            <tr>
                                                <td>Caesar Vance</td>
                                                <td>Pre-Sales Support</td>
                                                <td>New York</td>
                                                <td>21</td>
                                                <td>2011/12/12</td>
                                                <td>$106,450</td>
                                            </tr>
                                            <tr>
                                                <td>Doris Wilder</td>
                                                <td>Sales Assistant</td>
                                                <td>Sidney</td>
                                                <td>23</td>
                                                <td>2010/09/20</td>
                                                <td>$85,600</td>
                                            </tr>
                                            <tr>
                                                <td>Angelica Ramos</td>
                                                <td>Chief Executive Officer (CEO)</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2009/10/09</td>
                                                <td>$1,200,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gavin Joyce</td>
                                                <td>Developer</td>
                                                <td>Edinburgh</td>
                                                <td>42</td>
                                                <td>2010/12/22</td>
                                                <td>$92,575</td>
                                            </tr>
                                            <tr>
                                                <td>Jennifer Chang</td>
                                                <td>Regional Director</td>
                                                <td>Singapore</td>
                                                <td>28</td>
                                                <td>2010/11/14</td>
                                                <td>$357,650</td>
                                            </tr>
                                            <tr>
                                                <td>Brenden Wagner</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>28</td>
                                                <td>2011/06/07</td>
                                                <td>$206,850</td>
                                            </tr>
                                            <tr>
                                                <td>Fiona Green</td>
                                                <td>Chief Operating Officer (COO)</td>
                                                <td>San Francisco</td>
                                                <td>48</td>
                                                <td>2010/03/11</td>
                                                <td>$850,000</td>
                                            </tr>
                                            <tr>
                                                <td>Shou Itou</td>
                                                <td>Regional Marketing</td>
                                                <td>Tokyo</td>
                                                <td>20</td>
                                                <td>2011/08/14</td>
                                                <td>$163,000</td>
                                            </tr>
                                            <tr>
                                                <td>Michelle House</td>
                                                <td>Integration Specialist</td>
                                                <td>Sidney</td>
                                                <td>37</td>
                                                <td>2011/06/02</td>
                                                <td>$95,400</td>
                                            </tr>
                                            <tr>
                                                <td>Suki Burks</td>
                                                <td>Developer</td>
                                                <td>London</td>
                                                <td>53</td>
                                                <td>2009/10/22</td>
                                                <td>$114,500</td>
                                            </tr>
                                            <tr>
                                                <td>Prescott Bartlett</td>
                                                <td>Technical Author</td>
                                                <td>London</td>
                                                <td>27</td>
                                                <td>2011/05/07</td>
                                                <td>$145,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gavin Cortez</td>
                                                <td>Team Leader</td>
                                                <td>San Francisco</td>
                                                <td>22</td>
                                                <td>2008/10/26</td>
                                                <td>$235,500</td>
                                            </tr>
                                            <tr>
                                                <td>Martena Mccray</td>
                                                <td>Post-Sales support</td>
                                                <td>Edinburgh</td>
                                                <td>46</td>
                                                <td>2011/03/09</td>
                                                <td>$324,050</td>
                                            </tr>
                                            <tr>
                                                <td>Unity Butler</td>
                                                <td>Marketing Designer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/12/09</td>
                                                <td>$85,675</td>
                                            </tr>
                                            <tr>
                                                <td>Howard Hatfield</td>
                                                <td>Office Manager</td>
                                                <td>San Francisco</td>
                                                <td>51</td>
                                                <td>2008/12/16</td>
                                                <td>$164,500</td>
                                            </tr>
                                            <tr>
                                                <td>Hope Fuentes</td>
                                                <td>Secretary</td>
                                                <td>San Francisco</td>
                                                <td>41</td>
                                                <td>2010/02/12</td>
                                                <td>$109,850</td>
                                            </tr>
                                            <tr>
                                                <td>Vivian Harrell</td>
                                                <td>Financial Controller</td>
                                                <td>San Francisco</td>
                                                <td>62</td>
                                                <td>2009/02/14</td>
                                                <td>$452,500</td>
                                            </tr>
                                            <tr>
                                                <td>Timothy Mooney</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>37</td>
                                                <td>2008/12/11</td>
                                                <td>$136,200</td>
                                            </tr>
                                            <tr>
                                                <td>Jackson Bradshaw</td>
                                                <td>Director</td>
                                                <td>New York</td>
                                                <td>65</td>
                                                <td>2008/09/26</td>
                                                <td>$645,750</td>
                                            </tr>
                                            <tr>
                                                <td>Olivia Liang</td>
                                                <td>Support Engineer</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2011/02/03</td>
                                                <td>$234,500</td>
                                            </tr>
                                            <tr>
                                                <td>Bruno Nash</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>38</td>
                                                <td>2011/05/03</td>
                                                <td>$163,500</td>
                                            </tr>
                                            <tr>
                                                <td>Sakura Yamamoto</td>
                                                <td>Support Engineer</td>
                                                <td>Tokyo</td>
                                                <td>37</td>
                                                <td>2009/08/19</td>
                                                <td>$139,575</td>
                                            </tr>
                                            <tr>
                                                <td>Thor Walton</td>
                                                <td>Developer</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2013/08/11</td>
                                                <td>$98,540</td>
                                            </tr>
                                            <tr>
                                                <td>Finn Camacho</td>
                                                <td>Support Engineer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/07/07</td>
                                                <td>$87,500</td>
                                            </tr>
                                            <tr>
                                                <td>Serge Baldwin</td>
                                                <td>Data Coordinator</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2012/04/09</td>
                                                <td>$138,575</td>
                                            </tr>
                                            <tr>
                                                <td>Zenaida Frank</td>
                                                <td>Software Engineer</td>
                                                <td>New York</td>
                                                <td>63</td>
                                                <td>2010/01/04</td>
                                                <td>$125,250</td>
                                            </tr>
                                            <tr>
                                                <td>Zorita Serrano</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>56</td>
                                                <td>2012/06/01</td>
                                                <td>$115,000</td>
                                            </tr>
                                            <tr>
                                                <td>Jennifer Acosta</td>
                                                <td>Junior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>43</td>
                                                <td>2013/02/01</td>
                                                <td>$75,650</td>
                                            </tr>
                                            <tr>
                                                <td>Cara Stevens</td>
                                                <td>Sales Assistant</td>
                                                <td>New York</td>
                                                <td>46</td>
                                                <td>2011/12/06</td>
                                                <td>$145,600</td>
                                            </tr>
                                            <tr>
                                                <td>Hermione Butler</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2011/03/21</td>
                                                <td>$356,250</td>
                                            </tr>
                                            <tr>
                                                <td>Lael Greer</td>
                                                <td>Systems Administrator</td>
                                                <td>London</td>
                                                <td>21</td>
                                                <td>2009/02/27</td>
                                                <td>$103,500</td>
                                            </tr>
                                            <tr>
                                                <td>Jonas Alexander</td>
                                                <td>Developer</td>
                                                <td>San Francisco</td>
                                                <td>30</td>
                                                <td>2010/07/14</td>
                                                <td>$86,500</td>
                                            </tr>
                                            <tr>
                                                <td>Shad Decker</td>
                                                <td>Regional Director</td>
                                                <td>Edinburgh</td>
                                                <td>51</td>
                                                <td>2008/11/13</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Bruce</td>
                                                <td>Javascript Developer</td>
                                                <td>Singapore</td>
                                                <td>29</td>
                                                <td>2011/06/27</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Donna Snider</td>
                                                <td>Customer Support</td>
                                                <td>New York</td>
                                                <td>27</td>
                                                <td>2011/01/25</td>
                                                <td>$112,000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
									</div>
									<div class="tab-pane fade " id="bordered-html" role="tabpanel" aria-labelledby="home-tab-1">
										<div class="card-body pt-0 p-0 code-area">
<pre class="mb-0"><code class="language-html">
 &lt;div class="table-responsive"&gt;
&lt;table id="example2" class="display" style="width:100%"&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th&gt;Name&lt;/th&gt;
			&lt;th&gt;Position&lt;/th&gt;
			&lt;th&gt;Office&lt;/th&gt;
			&lt;th&gt;Age&lt;/th&gt;
			&lt;th&gt;Start date&lt;/th&gt;
			&lt;th&gt;Salary&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tbody&gt;
		&lt;tr&gt;
			&lt;td&gt;Tiger Nixon&lt;/td&gt;
			&lt;td&gt;System Architect&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;61&lt;/td&gt;
			&lt;td&gt;2011/04/25&lt;/td&gt;
			&lt;td&gt;$320,800&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Garrett Winters&lt;/td&gt;
			&lt;td&gt;Accountant&lt;/td&gt;
			&lt;td&gt;Tokyo&lt;/td&gt;
			&lt;td&gt;63&lt;/td&gt;
			&lt;td&gt;2011/07/25&lt;/td&gt;
			&lt;td&gt;$170,750&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Ashton Cox&lt;/td&gt;
			&lt;td&gt;Junior Technical Author&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;66&lt;/td&gt;
			&lt;td&gt;2009/01/12&lt;/td&gt;
			&lt;td&gt;$86,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Cedric Kelly&lt;/td&gt;
			&lt;td&gt;Senior Javascript Developer&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;22&lt;/td&gt;
			&lt;td&gt;2012/03/29&lt;/td&gt;
			&lt;td&gt;$433,060&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Accountant&lt;/td&gt;
			&lt;td&gt;Tokyo&lt;/td&gt;
			&lt;td&gt;33&lt;/td&gt;
			&lt;td&gt;2008/11/28&lt;/td&gt;
			&lt;td&gt;$162,700&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Brielle Williamson&lt;/td&gt;
			&lt;td&gt;Integration Specialist&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;61&lt;/td&gt;
			&lt;td&gt;2012/12/02&lt;/td&gt;
			&lt;td&gt;$372,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Herrod Chandler&lt;/td&gt;
			&lt;td&gt;Sales Assistant&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;59&lt;/td&gt;
			&lt;td&gt;2012/08/06&lt;/td&gt;
			&lt;td&gt;$137,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Rhona Davidson&lt;/td&gt;
			&lt;td&gt;Integration Specialist&lt;/td&gt;
			&lt;td&gt;Tokyo&lt;/td&gt;
			&lt;td&gt;55&lt;/td&gt;
			&lt;td&gt;2010/10/14&lt;/td&gt;
			&lt;td&gt;$327,900&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Colleen Hurst&lt;/td&gt;
			&lt;td&gt;Javascript Developer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;39&lt;/td&gt;
			&lt;td&gt;2009/09/15&lt;/td&gt;
			&lt;td&gt;$205,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;23&lt;/td&gt;
			&lt;td&gt;2008/12/13&lt;/td&gt;
			&lt;td&gt;$103,600&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jena Gaines&lt;/td&gt;
			&lt;td&gt;Office Manager&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;30&lt;/td&gt;
			&lt;td&gt;2008/12/19&lt;/td&gt;
			&lt;td&gt;$90,560&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Quinn Flynn&lt;/td&gt;
			&lt;td&gt;Support Lead&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;22&lt;/td&gt;
			&lt;td&gt;2013/03/03&lt;/td&gt;
			&lt;td&gt;$342,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Charde Marshall&lt;/td&gt;
			&lt;td&gt;Regional Director&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;36&lt;/td&gt;
			&lt;td&gt;2008/10/16&lt;/td&gt;
			&lt;td&gt;$470,600&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Haley Kennedy&lt;/td&gt;
			&lt;td&gt;Senior Marketing Designer&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;43&lt;/td&gt;
			&lt;td&gt;2012/12/18&lt;/td&gt;
			&lt;td&gt;$313,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Tatyana Fitzpatrick&lt;/td&gt;
			&lt;td&gt;Regional Director&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;19&lt;/td&gt;
			&lt;td&gt;2010/03/17&lt;/td&gt;
			&lt;td&gt;$385,750&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Michael Silva&lt;/td&gt;
			&lt;td&gt;Marketing Designer&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;66&lt;/td&gt;
			&lt;td&gt;2012/11/27&lt;/td&gt;
			&lt;td&gt;$198,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Paul Byrd&lt;/td&gt;
			&lt;td&gt;Chief Financial Officer (CFO)&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;64&lt;/td&gt;
			&lt;td&gt;2010/06/09&lt;/td&gt;
			&lt;td&gt;$725,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Gloria Little&lt;/td&gt;
			&lt;td&gt;Systems Administrator&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;59&lt;/td&gt;
			&lt;td&gt;2009/04/10&lt;/td&gt;
			&lt;td&gt;$237,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Bradley Greer&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;41&lt;/td&gt;
			&lt;td&gt;2012/10/13&lt;/td&gt;
			&lt;td&gt;$132,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Dai Rios&lt;/td&gt;
			&lt;td&gt;Personnel Lead&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;35&lt;/td&gt;
			&lt;td&gt;2012/09/26&lt;/td&gt;
			&lt;td&gt;$217,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jenette Caldwell&lt;/td&gt;
			&lt;td&gt;Development Lead&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;30&lt;/td&gt;
			&lt;td&gt;2011/09/03&lt;/td&gt;
			&lt;td&gt;$345,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Yuri Berry&lt;/td&gt;
			&lt;td&gt;Chief Marketing Officer (CMO)&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;40&lt;/td&gt;
			&lt;td&gt;2009/06/25&lt;/td&gt;
			&lt;td&gt;$675,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Caesar Vance&lt;/td&gt;
			&lt;td&gt;Pre-Sales Support&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;21&lt;/td&gt;
			&lt;td&gt;2011/12/12&lt;/td&gt;
			&lt;td&gt;$106,450&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Doris Wilder&lt;/td&gt;
			&lt;td&gt;Sales Assistant&lt;/td&gt;
			&lt;td&gt;Sidney&lt;/td&gt;
			&lt;td&gt;23&lt;/td&gt;
			&lt;td&gt;2010/09/20&lt;/td&gt;
			&lt;td&gt;$85,600&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Angelica Ramos&lt;/td&gt;
			&lt;td&gt;Chief Executive Officer (CEO)&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;47&lt;/td&gt;
			&lt;td&gt;2009/10/09&lt;/td&gt;
			&lt;td&gt;$1,200,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Gavin Joyce&lt;/td&gt;
			&lt;td&gt;Developer&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;42&lt;/td&gt;
			&lt;td&gt;2010/12/22&lt;/td&gt;
			&lt;td&gt;$92,575&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jennifer Chang&lt;/td&gt;
			&lt;td&gt;Regional Director&lt;/td&gt;
			&lt;td&gt;Singapore&lt;/td&gt;
			&lt;td&gt;28&lt;/td&gt;
			&lt;td&gt;2010/11/14&lt;/td&gt;
			&lt;td&gt;$357,650&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Brenden Wagner&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;28&lt;/td&gt;
			&lt;td&gt;2011/06/07&lt;/td&gt;
			&lt;td&gt;$206,850&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Fiona Green&lt;/td&gt;
			&lt;td&gt;Chief Operating Officer (COO)&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;48&lt;/td&gt;
			&lt;td&gt;2010/03/11&lt;/td&gt;
			&lt;td&gt;$850,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Shou Itou&lt;/td&gt;
			&lt;td&gt;Regional Marketing&lt;/td&gt;
			&lt;td&gt;Tokyo&lt;/td&gt;
			&lt;td&gt;20&lt;/td&gt;
			&lt;td&gt;2011/08/14&lt;/td&gt;
			&lt;td&gt;$163,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Michelle House&lt;/td&gt;
			&lt;td&gt;Integration Specialist&lt;/td&gt;
			&lt;td&gt;Sidney&lt;/td&gt;
			&lt;td&gt;37&lt;/td&gt;
			&lt;td&gt;2011/06/02&lt;/td&gt;
			&lt;td&gt;$95,400&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Suki Burks&lt;/td&gt;
			&lt;td&gt;Developer&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;53&lt;/td&gt;
			&lt;td&gt;2009/10/22&lt;/td&gt;
			&lt;td&gt;$114,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Prescott Bartlett&lt;/td&gt;
			&lt;td&gt;Technical Author&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;27&lt;/td&gt;
			&lt;td&gt;2011/05/07&lt;/td&gt;
			&lt;td&gt;$145,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Gavin Cortez&lt;/td&gt;
			&lt;td&gt;Team Leader&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;22&lt;/td&gt;
			&lt;td&gt;2008/10/26&lt;/td&gt;
			&lt;td&gt;$235,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Martena Mccray&lt;/td&gt;
			&lt;td&gt;Post-Sales support&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;46&lt;/td&gt;
			&lt;td&gt;2011/03/09&lt;/td&gt;
			&lt;td&gt;$324,050&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Unity Butler&lt;/td&gt;
			&lt;td&gt;Marketing Designer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;47&lt;/td&gt;
			&lt;td&gt;2009/12/09&lt;/td&gt;
			&lt;td&gt;$85,675&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Howard Hatfield&lt;/td&gt;
			&lt;td&gt;Office Manager&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;51&lt;/td&gt;
			&lt;td&gt;2008/12/16&lt;/td&gt;
			&lt;td&gt;$164,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Hope Fuentes&lt;/td&gt;
			&lt;td&gt;Secretary&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;41&lt;/td&gt;
			&lt;td&gt;2010/02/12&lt;/td&gt;
			&lt;td&gt;$109,850&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Vivian Harrell&lt;/td&gt;
			&lt;td&gt;Financial Controller&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;62&lt;/td&gt;
			&lt;td&gt;2009/02/14&lt;/td&gt;
			&lt;td&gt;$452,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Timothy Mooney&lt;/td&gt;
			&lt;td&gt;Office Manager&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;37&lt;/td&gt;
			&lt;td&gt;2008/12/11&lt;/td&gt;
			&lt;td&gt;$136,200&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jackson Bradshaw&lt;/td&gt;
			&lt;td&gt;Director&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;65&lt;/td&gt;
			&lt;td&gt;2008/09/26&lt;/td&gt;
			&lt;td&gt;$645,750&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Olivia Liang&lt;/td&gt;
			&lt;td&gt;Support Engineer&lt;/td&gt;
			&lt;td&gt;Singapore&lt;/td&gt;
			&lt;td&gt;64&lt;/td&gt;
			&lt;td&gt;2011/02/03&lt;/td&gt;
			&lt;td&gt;$234,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Bruno Nash&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;38&lt;/td&gt;
			&lt;td&gt;2011/05/03&lt;/td&gt;
			&lt;td&gt;$163,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Sakura Yamamoto&lt;/td&gt;
			&lt;td&gt;Support Engineer&lt;/td&gt;
			&lt;td&gt;Tokyo&lt;/td&gt;
			&lt;td&gt;37&lt;/td&gt;
			&lt;td&gt;2009/08/19&lt;/td&gt;
			&lt;td&gt;$139,575&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Thor Walton&lt;/td&gt;
			&lt;td&gt;Developer&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;61&lt;/td&gt;
			&lt;td&gt;2013/08/11&lt;/td&gt;
			&lt;td&gt;$98,540&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Finn Camacho&lt;/td&gt;
			&lt;td&gt;Support Engineer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;47&lt;/td&gt;
			&lt;td&gt;2009/07/07&lt;/td&gt;
			&lt;td&gt;$87,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Serge Baldwin&lt;/td&gt;
			&lt;td&gt;Data Coordinator&lt;/td&gt;
			&lt;td&gt;Singapore&lt;/td&gt;
			&lt;td&gt;64&lt;/td&gt;
			&lt;td&gt;2012/04/09&lt;/td&gt;
			&lt;td&gt;$138,575&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Zenaida Frank&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;63&lt;/td&gt;
			&lt;td&gt;2010/01/04&lt;/td&gt;
			&lt;td&gt;$125,250&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Zorita Serrano&lt;/td&gt;
			&lt;td&gt;Software Engineer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;56&lt;/td&gt;
			&lt;td&gt;2012/06/01&lt;/td&gt;
			&lt;td&gt;$115,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jennifer Acosta&lt;/td&gt;
			&lt;td&gt;Junior Javascript Developer&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;43&lt;/td&gt;
			&lt;td&gt;2013/02/01&lt;/td&gt;
			&lt;td&gt;$75,650&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Cara Stevens&lt;/td&gt;
			&lt;td&gt;Sales Assistant&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;46&lt;/td&gt;
			&lt;td&gt;2011/12/06&lt;/td&gt;
			&lt;td&gt;$145,600&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Hermione Butler&lt;/td&gt;
			&lt;td&gt;Regional Director&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;47&lt;/td&gt;
			&lt;td&gt;2011/03/21&lt;/td&gt;
			&lt;td&gt;$356,250&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Lael Greer&lt;/td&gt;
			&lt;td&gt;Systems Administrator&lt;/td&gt;
			&lt;td&gt;London&lt;/td&gt;
			&lt;td&gt;21&lt;/td&gt;
			&lt;td&gt;2009/02/27&lt;/td&gt;
			&lt;td&gt;$103,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Jonas Alexander&lt;/td&gt;
			&lt;td&gt;Developer&lt;/td&gt;
			&lt;td&gt;San Francisco&lt;/td&gt;
			&lt;td&gt;30&lt;/td&gt;
			&lt;td&gt;2010/07/14&lt;/td&gt;
			&lt;td&gt;$86,500&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Shad Decker&lt;/td&gt;
			&lt;td&gt;Regional Director&lt;/td&gt;
			&lt;td&gt;Edinburgh&lt;/td&gt;
			&lt;td&gt;51&lt;/td&gt;
			&lt;td&gt;2008/11/13&lt;/td&gt;
			&lt;td&gt;$183,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Michael Bruce&lt;/td&gt;
			&lt;td&gt;Javascript Developer&lt;/td&gt;
			&lt;td&gt;Singapore&lt;/td&gt;
			&lt;td&gt;29&lt;/td&gt;
			&lt;td&gt;2011/06/27&lt;/td&gt;
			&lt;td&gt;$183,000&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;Donna Snider&lt;/td&gt;
			&lt;td&gt;Customer Support&lt;/td&gt;
			&lt;td&gt;New York&lt;/td&gt;
			&lt;td&gt;27&lt;/td&gt;
			&lt;td&gt;2011/01/25&lt;/td&gt;
			&lt;td&gt;$112,000&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/tbody&gt;
	&lt;tfoot&gt;
		&lt;tr&gt;
			&lt;th&gt;Name&lt;/th&gt;
			&lt;th&gt;Position&lt;/th&gt;
			&lt;th&gt;Office&lt;/th&gt;
			&lt;th&gt;Age&lt;/th&gt;
			&lt;th&gt;Start date&lt;/th&gt;
			&lt;th&gt;Salary&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/tfoot&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/div&gt;</code></pre>
									</div>
									</div>
								</div>
								<!-- /tab-content -->

							</div>
						</div>
						<!-- Column ends -->
						<!-- Column starts -->
						<div class="col-xl-12">
							<div class="card dz-card" id="accordion-three">
								<div class="card-header flex-wrap d-flex justify-content-between">
									<div>
									<h4 class="card-title">Profile Datatable</h4>
									<p class="m-0 subtitle">Add <code>profile</code> class with <code>datatables</code></p>
									</div>
									<ul class="nav nav-tabs dzm-tabs" id="myTab-2" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active " id="home-tab-2" data-bs-toggle="tab" data-bs-target="#withoutSpace" type="button" role="tab" aria-selected="true">Preview</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link " id="profile-tab-2" data-bs-toggle="tab" data-bs-target="#withoutSpace-html" type="button" role="tab"  aria-selected="false">HTML</button>
										</li>
									</ul>
								</div>

									<!-- /tab-content -->
									<div class="tab-content" id="myTabContent-2">
										<div class="tab-pane fade show active" id="withoutSpace" role="tabpanel" aria-labelledby="home-tab-2">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example3" class="display table" style="min-width: 845px">
														<thead>
															<tr>
																<th></th>
																<th>Name</th>
																<th>Department</th>
																<th>Gender</th>
																<th>Education</th>
																<th>Mobile</th>
																<th>Email</th>
																<th>Joining Date</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""></td>
																<td>Tiger Nixon</td>
																<td>Architect</td>
																<td>Male</td>
																<td>M.COM., P.H.D.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/04/25</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""></td>
																<td>Garrett Winters</td>
																<td>Accountant</td>
																<td>Female</td>
																<td>M.COM., P.H.D.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/07/25</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""></td>
																<td>Ashton Cox</td>
																<td>Junior Technical</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2009/01/12</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""></td>
																<td>Cedric Kelly</td>
																<td>Developer</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/03/29</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""></td>
																<td>Airi Satou</td>
																<td>Accountant</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2008/11/28</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""></td>
																<td>Brielle Williamson</td>
																<td>Specialist</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/12/02</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""></td>
																<td>Herrod Chandler</td>
																<td>Sales Assistant</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/08/06</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""></td>
																<td>Rhona Davidson</td>
																<td>Integration</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/10/14</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""></td>
																<td>Colleen Hurst</td>
																<td>Javascript Developer</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2009/09/15</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""></td>
																<td>Sonya Frost</td>
																<td>Software Engineer</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2008/12/13</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""></td>
																<td>Jena Gaines</td>
																<td>Office Manager</td>
																<td>Female</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2008/12/19</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""></td>
																<td>Quinn Flynn</td>
																<td>Support Lead</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2013/03/03</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""></td>
																<td>Charde Marshall</td>
																<td>Regional Director</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2008/10/16</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""></td>
																<td>Haley Kennedy</td>
																<td>Senior Marketing</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/12/18</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""></td>
																<td>Tatyana Fitzpatrick</td>
																<td>Regional Director</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/03/17</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""></td>
																<td>Michael Silva</td>
																<td>Marketing Designer</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/11/27</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""></td>
																<td>Paul Byrd</td>
																<td>Financial Officer</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/06/09</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""></td>
																<td>Gloria Little</td>
																<td>Systems Administrator</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2009/04/10</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""></td>
																<td>Bradley Greer</td>
																<td>Software Engineer</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/10/13</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""></td>
																<td>Dai Rios</td>
																<td>Personnel Lead</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2012/09/26</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""></td>
																<td>Jenette Caldwell</td>
																<td>Development Lead</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/09/03</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""></td>
																<td>Yuri Berry</td>
																<td>Marketing Officer</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2009/06/25</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""></td>
																<td>Caesar Vance</td>
																<td>Pre-Sales Support</td>
																<td>Male</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/12/12</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""></td>
																<td>Doris Wilder</td>
																<td>Sales Assistant</td>
																<td>Female</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/09/20</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""></td>
																<td>Angelica Ramos</td>
																<td>Executive Officer</td>
																<td>Male</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2009/10/09</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""></td>
																<td>Gavin Joyce</td>
																<td>Developer</td>
																<td>Female</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/12/22</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""></td>
																<td>Jennifer Chang</td>
																<td>Regional Director</td>
																<td>Male</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/11/14</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""></td>
																<td>Brenden Wagner</td>
																<td>Software Engineer</td>
																<td>Female</td>
																<td>B.TACH, M.TACH</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/06/07</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""></td>
																<td>Fiona Green</td>
																<td>Operating Officer</td>
																<td>Male</td>
																<td>B.A, B.C.A</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2010/03/11</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""></td>
																<td>Shou Itou</td>
																<td>Regional Marketing</td>
																<td>Female</td>
																<td>B.COM., M.COM.</td>
																<td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
																<td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
																<td>2011/08/14</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
																		<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="tab-pane fade " id="withoutSpace-html" role="tabpanel" aria-labelledby="home-tab-2">
											<div class="card-body pt-0 p-0 code-area">
	<pre class="mb-0"><code class="language-html">&lt;div class="table-responsive"&gt;
&lt;table id="example3" class="display table" style="min-width: 845px"&gt;
&lt;thead&gt;
	&lt;tr&gt;
		&lt;th&gt;&lt;/th&gt;
		&lt;th&gt;Name&lt;/th&gt;
		&lt;th&gt;Department&lt;/th&gt;
		&lt;th&gt;Gender&lt;/th&gt;
		&lt;th&gt;Education&lt;/th&gt;
		&lt;th&gt;Mobile&lt;/th&gt;
		&lt;th&gt;Email&lt;/th&gt;
		&lt;th&gt;Joining Date&lt;/th&gt;
		&lt;th&gt;Action&lt;/th&gt;
	&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Tiger Nixon&lt;/td&gt;
		&lt;td&gt;Architect&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;M.COM., P.H.D.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/04/25&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Garrett Winters&lt;/td&gt;
		&lt;td&gt;Accountant&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;M.COM., P.H.D.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/07/25&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Ashton Cox&lt;/td&gt;
		&lt;td&gt;Junior Technical&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2009/01/12&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Cedric Kelly&lt;/td&gt;
		&lt;td&gt;Developer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/03/29&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Airi Satou&lt;/td&gt;
		&lt;td&gt;Accountant&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2008/11/28&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Brielle Williamson&lt;/td&gt;
		&lt;td&gt;Specialist&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/12/02&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Herrod Chandler&lt;/td&gt;
		&lt;td&gt;Sales Assistant&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/08/06&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Rhona Davidson&lt;/td&gt;
		&lt;td&gt;Integration&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/10/14&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Colleen Hurst&lt;/td&gt;
		&lt;td&gt;Javascript Developer&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2009/09/15&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Sonya Frost&lt;/td&gt;
		&lt;td&gt;Software Engineer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2008/12/13&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Jena Gaines&lt;/td&gt;
		&lt;td&gt;Office Manager&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2008/12/19&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Quinn Flynn&lt;/td&gt;
		&lt;td&gt;Support Lead&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2013/03/03&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Charde Marshall&lt;/td&gt;
		&lt;td&gt;Regional Director&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2008/10/16&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Haley Kennedy&lt;/td&gt;
		&lt;td&gt;Senior Marketing&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/12/18&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Tatyana Fitzpatrick&lt;/td&gt;
		&lt;td&gt;Regional Director&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/03/17&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Michael Silva&lt;/td&gt;
		&lt;td&gt;Marketing Designer&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/11/27&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Paul Byrd&lt;/td&gt;
		&lt;td&gt;Financial Officer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/06/09&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Gloria Little&lt;/td&gt;
		&lt;td&gt;Systems Administrator&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2009/04/10&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Bradley Greer&lt;/td&gt;
		&lt;td&gt;Software Engineer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/10/13&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Dai Rios&lt;/td&gt;
		&lt;td&gt;Personnel Lead&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2012/09/26&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic1.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Jenette Caldwell&lt;/td&gt;
		&lt;td&gt;Development Lead&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/09/03&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic2.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Yuri Berry&lt;/td&gt;
		&lt;td&gt;Marketing Officer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2009/06/25&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic3.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Caesar Vance&lt;/td&gt;
		&lt;td&gt;Pre-Sales Support&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/12/12&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic4.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Doris Wilder&lt;/td&gt;
		&lt;td&gt;Sales Assistant&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/09/20&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic5.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Angelica Ramos&lt;/td&gt;
		&lt;td&gt;Executive Officer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2009/10/09&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic6.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Gavin Joyce&lt;/td&gt;
		&lt;td&gt;Developer&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/12/22&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic7.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Jennifer Chang&lt;/td&gt;
		&lt;td&gt;Regional Director&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/11/14&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic8.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Brenden Wagner&lt;/td&gt;
		&lt;td&gt;Software Engineer&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.TACH, M.TACH&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/06/07&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic9.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Fiona Green&lt;/td&gt;
		&lt;td&gt;Operating Officer&lt;/td&gt;
		&lt;td&gt;Male&lt;/td&gt;
		&lt;td&gt;B.A, B.C.A&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2010/03/11&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;img class="rounded-circle" width="35" src="{{asset('images/profile/small/pic10.jpg')}}" alt=""&gt;&lt;/td&gt;
		&lt;td&gt;Shou Itou&lt;/td&gt;
		&lt;td&gt;Regional Marketing&lt;/td&gt;
		&lt;td&gt;Female&lt;/td&gt;
		&lt;td&gt;B.COM., M.COM.&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;123 456 7890&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;&lt;a href="javascript:void(0);"&gt;&lt;strong&gt;info@example.com&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;
		&lt;td&gt;2011/08/14&lt;/td&gt;
		&lt;td&gt;
			&lt;div class="d-flex"&gt;
				&lt;a href="#" class="btn btn-primary shadow btn-xs sharp me-1"&gt;&lt;i class="fas fa-pencil-alt"&gt;&lt;/i&gt;&lt;/a&gt;
				&lt;a href="#" class="btn btn-danger shadow btn-xs sharp"&gt;&lt;i class="fa fa-trash"&gt;&lt;/i&gt;&lt;/a&gt;
			&lt;/div&gt;
		&lt;/td&gt;
	&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;</code></pre></div>
										</div>
									</div>
									<!-- /tab-content -->

							</div>
						</div>
                    <!-- Column ends -->
					<!-- Column starts -->
                    <div class="col-xl-12">
                        <div class="card dz-card" id="accordion-four">
                            <div class="card-header flex-wrap d-flex justify-content-between">
								<div>
									<h4 class="card-title">Fees Collection</h4>
									<p class="m-0 subtitle">Add <code>fees</code> class with <code>datatables</code></p>
								</div>
								<ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
									<li class="nav-item" role="presentation">
										<button class="nav-link active " id="home-tab-3" data-bs-toggle="tab" data-bs-target="#withoutBorder" type="button" role="tab"  aria-selected="true">Preview</button>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link " id="profile-tab-3" data-bs-toggle="tab" data-bs-target="#withoutBorder-html" type="button" role="tab"  aria-selected="false">HTML</button>
									</li>
								</ul>
							</div>

                               	<!-- /tab-content -->
								<div class="tab-content" id="myTabContent-3">
									<div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
										<div class="card-body pt-0">
											<div class="table-responsive">
												<table id="example4" class="display table" style="min-width: 845px">
													<thead>
														<tr>
															<th>Roll No</th>
															<th>Student Name</th>
															<th>Invoice number</th>
															<th>Fees Type </th>
															<th>Payment Type </th>
															<th>Status </th>
															<th>Date</th>
															<th>Amount</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>01</td>
															<td>Tiger Nixon</td>
															<td>#54605</td>
															<td>Library</td>
															<td>Cash</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2011/04/25</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>02</td>
															<td>Garrett Winters</td>
															<td>#54687</td>
															<td>Library</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2011/07/25</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>03</td>
															<td>Ashton Cox</td>
															<td>#35672</td>
															<td>Tuition</td>
															<td>Cash</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2009/01/12</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>04</td>
															<td>Cedric Kelly</td>
															<td>#57984</td>
															<td>Annual</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2012/03/29</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>05</td>
															<td>Airi Satou</td>
															<td>#12453</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2008/11/28</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>06</td>
															<td>Brielle Williamson</td>
															<td>#59723</td>
															<td>Tuition</td>
															<td>Cash</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2012/12/02</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>07</td>
															<td>Herrod Chandler</td>
															<td>#98726</td>
															<td>Tuition</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2012/08/06</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>08</td>
															<td>Rhona Davidson</td>
															<td>#98721</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2010/10/14</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>09</td>
															<td>Colleen Hurst</td>
															<td>#54605</td>
															<td>Annual</td>
															<td>Cheque</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2009/09/15</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>10</td>
															<td>Sonya Frost</td>
															<td>#98734</td>
															<td>Tuition</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2008/12/13</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>11</td>
															<td>Jena Gaines</td>
															<td>#12457</td>
															<td>Tuition</td>
															<td>Cash</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2008/12/19</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>12</td>
															<td>Quinn Flynn</td>
															<td>#36987</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2013/03/03</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>13</td>
															<td>Charde Marshall</td>
															<td>#98756</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2008/10/16</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>14</td>
															<td>Haley Kennedy</td>
															<td>#98754</td>
															<td>Library</td>
															<td>Cash</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2012/12/18</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>15</td>
															<td>Tatyana Fitzpatrick</td>
															<td>#65248</td>
															<td>Annual</td>
															<td>Cheque</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2010/03/17</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>16</td>
															<td>Michael Silva</td>
															<td>#75943</td>
															<td>Tuition</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2012/11/27</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>17</td>
															<td>Paul Byrd</td>
															<td>#87954</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2010/06/09</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>18</td>
															<td>Gloria Little</td>
															<td>#98746</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2009/04/10</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>19</td>
															<td>Bradley Greer</td>
															<td>#98674</td>
															<td>Annual</td>
															<td>Cash</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2012/10/13</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>20</td>
															<td>Dai Rios</td>
															<td>#69875</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2012/09/26</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>21</td>
															<td>Jenette Caldwell</td>
															<td>#54678</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2011/09/03</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>22</td>
															<td>Yuri Berry</td>
															<td>#98756</td>
															<td>Tuition</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2009/06/25</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>23</td>
															<td>Caesar Vance</td>
															<td>#86754</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2011/12/12</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>24</td>
															<td>Doris Wilder</td>
															<td>#34251</td>
															<td>Annual</td>
															<td>Cash</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2010/09/20</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>25</td>
															<td>Angelica Ramos</td>
															<td>#65874</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2009/10/09</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>26</td>
															<td>Gavin Joyce</td>
															<td>#54605</td>
															<td>Female</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2010/12/22</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>27</td>
															<td>Jennifer Chang</td>
															<td>#54605</td>
															<td>Tuition</td>
															<td>Cheque</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2010/11/14</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>28</td>
															<td>Brenden Wagner</td>
															<td>#45687</td>
															<td>Library</td>
															<td>Cheque</td>
															<td><span class="badge light badge-danger">Udpaid</span></td>
															<td>2011/06/07</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>29</td>
															<td>Fiona Green</td>
															<td>#23456</td>
															<td>Tuition</td>
															<td>Cash</td>
															<td><span class="badge light badge-success">Paid</span></td>
															<td>2010/03/11</td>
															<td><strong>120$</strong></td>
														</tr>
														<tr>
															<td>30</td>
															<td>Shou Itou</td>
															<td>#54605</td>
															<td>Annual</td>
															<td>Credit Card</td>
															<td><span class="badge light badge-warning">Panding</span></td>
															<td>2011/08/14</td>
															<td><strong>120$</strong></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade " id="withoutBorder-html" role="tabpanel" aria-labelledby="home-tab-3">
										<div class="card-body pt-0 p-0 code-area">
<pre class="mb-0"><code class="language-html">&lt;div class="table-responsive"&gt;
	&lt;table id="example4" class="display table" style="min-width: 845px"&gt;
		&lt;thead&gt;
			&lt;tr&gt;
				&lt;th&gt;Roll No&lt;/th&gt;
				&lt;th&gt;Student Name&lt;/th&gt;
				&lt;th&gt;Invoice number&lt;/th&gt;
				&lt;th&gt;Fees Type &lt;/th&gt;
				&lt;th&gt;Payment Type &lt;/th&gt;
				&lt;th&gt;Status &lt;/th&gt;
				&lt;th&gt;Date&lt;/th&gt;
				&lt;th&gt;Amount&lt;/th&gt;
			&lt;/tr&gt;
		&lt;/thead&gt;
		&lt;tbody&gt;
			&lt;tr&gt;
				&lt;td&gt;01&lt;/td&gt;
				&lt;td&gt;Tiger Nixon&lt;/td&gt;
				&lt;td&gt;#54605&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/04/25&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;02&lt;/td&gt;
				&lt;td&gt;Garrett Winters&lt;/td&gt;
				&lt;td&gt;#54687&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/07/25&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;03&lt;/td&gt;
				&lt;td&gt;Ashton Cox&lt;/td&gt;
				&lt;td&gt;#35672&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2009/01/12&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;04&lt;/td&gt;
				&lt;td&gt;Cedric Kelly&lt;/td&gt;
				&lt;td&gt;#57984&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/03/29&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;05&lt;/td&gt;
				&lt;td&gt;Airi Satou&lt;/td&gt;
				&lt;td&gt;#12453&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2008/11/28&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;06&lt;/td&gt;
				&lt;td&gt;Brielle Williamson&lt;/td&gt;
				&lt;td&gt;#59723&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/12/02&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;07&lt;/td&gt;
				&lt;td&gt;Herrod Chandler&lt;/td&gt;
				&lt;td&gt;#98726&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/08/06&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;08&lt;/td&gt;
				&lt;td&gt;Rhona Davidson&lt;/td&gt;
				&lt;td&gt;#98721&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/10/14&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;09&lt;/td&gt;
				&lt;td&gt;Colleen Hurst&lt;/td&gt;
				&lt;td&gt;#54605&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2009/09/15&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;10&lt;/td&gt;
				&lt;td&gt;Sonya Frost&lt;/td&gt;
				&lt;td&gt;#98734&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2008/12/13&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;11&lt;/td&gt;
				&lt;td&gt;Jena Gaines&lt;/td&gt;
				&lt;td&gt;#12457&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2008/12/19&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;12&lt;/td&gt;
				&lt;td&gt;Quinn Flynn&lt;/td&gt;
				&lt;td&gt;#36987&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2013/03/03&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;13&lt;/td&gt;
				&lt;td&gt;Charde Marshall&lt;/td&gt;
				&lt;td&gt;#98756&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2008/10/16&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;14&lt;/td&gt;
				&lt;td&gt;Haley Kennedy&lt;/td&gt;
				&lt;td&gt;#98754&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/12/18&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;15&lt;/td&gt;
				&lt;td&gt;Tatyana Fitzpatrick&lt;/td&gt;
				&lt;td&gt;#65248&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/03/17&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;16&lt;/td&gt;
				&lt;td&gt;Michael Silva&lt;/td&gt;
				&lt;td&gt;#75943&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/11/27&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;17&lt;/td&gt;
				&lt;td&gt;Paul Byrd&lt;/td&gt;
				&lt;td&gt;#87954&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/06/09&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;18&lt;/td&gt;
				&lt;td&gt;Gloria Little&lt;/td&gt;
				&lt;td&gt;#98746&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2009/04/10&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;19&lt;/td&gt;
				&lt;td&gt;Bradley Greer&lt;/td&gt;
				&lt;td&gt;#98674&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/10/13&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;20&lt;/td&gt;
				&lt;td&gt;Dai Rios&lt;/td&gt;
				&lt;td&gt;#69875&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2012/09/26&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;21&lt;/td&gt;
				&lt;td&gt;Jenette Caldwell&lt;/td&gt;
				&lt;td&gt;#54678&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/09/03&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;22&lt;/td&gt;
				&lt;td&gt;Yuri Berry&lt;/td&gt;
				&lt;td&gt;#98756&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2009/06/25&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;23&lt;/td&gt;
				&lt;td&gt;Caesar Vance&lt;/td&gt;
				&lt;td&gt;#86754&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/12/12&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;24&lt;/td&gt;
				&lt;td&gt;Doris Wilder&lt;/td&gt;
				&lt;td&gt;#34251&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/09/20&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;25&lt;/td&gt;
				&lt;td&gt;Angelica Ramos&lt;/td&gt;
				&lt;td&gt;#65874&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2009/10/09&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;26&lt;/td&gt;
				&lt;td&gt;Gavin Joyce&lt;/td&gt;
				&lt;td&gt;#54605&lt;/td&gt;
				&lt;td&gt;Female&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/12/22&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;27&lt;/td&gt;
				&lt;td&gt;Jennifer Chang&lt;/td&gt;
				&lt;td&gt;#54605&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/11/14&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;28&lt;/td&gt;
				&lt;td&gt;Brenden Wagner&lt;/td&gt;
				&lt;td&gt;#45687&lt;/td&gt;
				&lt;td&gt;Library&lt;/td&gt;
				&lt;td&gt;Cheque&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/06/07&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;29&lt;/td&gt;
				&lt;td&gt;Fiona Green&lt;/td&gt;
				&lt;td&gt;#23456&lt;/td&gt;
				&lt;td&gt;Tuition&lt;/td&gt;
				&lt;td&gt;Cash&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2010/03/11&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td&gt;30&lt;/td&gt;
				&lt;td&gt;Shou Itou&lt;/td&gt;
				&lt;td&gt;#54605&lt;/td&gt;
				&lt;td&gt;Annual&lt;/td&gt;
				&lt;td&gt;Credit Card&lt;/td&gt;
				&lt;td&gt;&lt;span class="badge light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
				&lt;td&gt;2011/08/14&lt;/td&gt;
				&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
			&lt;/tr&gt;
		&lt;/tbody&gt;
	&lt;/table&gt;
&lt;/div&gt;</code></pre>
								</div>
									</div>
								</div>
							<!-- /tab-content -->

                        </div>
                    </div>
                    <!-- Column ends -->
					<!-- Column starts -->
                    <div class="col-xl-12">
                        <div class="card dz-card" id="accordion-five">
                            <div class="card-header flex-wrap d-flex justify-content-between">
								<div>
                                	<h4 class="card-title">Patient</h4>
                                	<p class="m-0 subtitle">Add <code>Patient</code> class with <code>datatables</code></p>
								</div>
								<ul class="nav nav-tabs dzm-tabs" id="myTab-4" role="tablist">
									<li class="nav-item" role="presentation">
										<button class="nav-link active " id="home-tab-4" data-bs-toggle="tab" data-bs-target="#leftPosition" type="button" role="tab" aria-selected="true">Preview</button>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link " id="profile-tab-4" data-bs-toggle="tab" data-bs-target="#leftPosition-html" type="button" role="tab"  aria-selected="false">HTML</button>
									</li>
								</ul>
							</div>
                           	<!-- tab-content -->
							<div class="tab-content" id="myTabContent-4">
								<div class="tab-pane fade show active" id="leftPosition" role="tabpanel" aria-labelledby="home-tab-4">
									<div class="card-body">
									<div class="table-responsive">
										<table id="example5" class="display table" style="min-width: 845px">
											<thead>
												<tr>
													<th>
														<div class="custom-control d-inline custom-checkbox">
															<input type="checkbox" class="form-check-input" id="checkAll" required="">
															<label class="form-check-label" for="checkAll"></label>
														</div>
													</th>
													<th>Patient ID</th>
													<th>Date Check in</th>
													<th>Patient Name</th>
													<th>Doctor Assgined</th>
													<th>Disease</th>
													<th>Status</th>
													<th>Room no</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
															<label class="form-check-label" for="customCheckBox2"></label>
														</div>
													</td>
													<td>#P-00001</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Tiger Nixon</td>
													<td>Dr. Cedric</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-001</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox3" required="">
															<label class="form-check-label" for="customCheckBox3"></label>
														</div>
													</td>
													<td>#P-00002</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Garrett Winters</td>
													<td>Dr. Cedric</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-002</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox4" required="">
															<label class="form-check-label" for="customCheckBox4"></label>
														</div>
													</td>
													<td>#P-00003</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Ashton Cox</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-success">
															<i class="fa fa-circle text-success me-1"></i>
															Recovered
														</span>
													</td>
													<td>AB-003</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox5" required="">
															<label class="form-check-label" for="customCheckBox5"></label>
														</div>
													</td>
													<td>#P-00004</td>
													<td>29/02/2020, 12:42 AM</td>
													<td>Ashton Cox</td>
													<td>Dr. Cedric</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-004</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox6" required="">
															<label class="form-check-label" for="customCheckBox6"></label>
														</div>
													</td>
													<td>#P-00005</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Ashton Cox</td>
													<td>Dr. Cedric</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-005</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox7" required="">
															<label class="form-check-label" for="customCheckBox7"></label>
														</div>
													</td>
													<td>#P-00006</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Ashton Cox</td>
													<td>Dr. Rhona</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-006</td>
													<td>
														<div class="dropdown ms-auto text-end">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox8" required="">
															<label class="form-check-label" for="customCheckBox8"></label>
														</div>
													</td>
													<td>#P-00007</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Airi Satou</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-007</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox9" required="">
															<label class="form-check-label" for="customCheckBox9"></label>
														</div>
													</td>
													<td>#P-00008</td>
													<td>29/02/2020, 12:42 AM</td>
													<td>Airi Satou</td>
													<td>Dr. Garrett </td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-008</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox10" required="">
															<label class="form-check-label" for="customCheckBox10"></label>
														</div>
													</td>
													<td>#P-00009</td>
													<td>25/02/2020, 12:42 AM</td>
													<td>Airi Satou</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-009</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox11" required="">
															<label class="form-check-label" for="customCheckBox11"></label>
														</div>
													</td>
													<td>#P-00010</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Airi Satou</td>
													<td>Dr. Rhona</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-010</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox12" required="">
															<label class="form-check-label" for="customCheckBox12"></label>
														</div>
													</td>
													<td>#P-00011</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Airi Satou</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-011</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox13" required="">
															<label class="form-check-label" for="customCheckBox13"></label>
														</div>
													</td>
													<td>#P-00012</td>
													<td>29/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Garrett</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-012</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox14" required="">
															<label class="form-check-label" for="customCheckBox14"></label>
														</div>
													</td>
													<td>#P-00013</td>
													<td>25/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-013</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox15" required="">
															<label class="form-check-label" for="customCheckBox15"></label>
														</div>
													</td>
													<td>#P-00014</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Garrett</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-014</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox16" required="">
															<label class="form-check-label" for="customCheckBox16"></label>
														</div>
													</td>
													<td>#P-00015</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-015</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox17" required="">
															<label class="form-check-label" for="customCheckBox17"></label>
														</div>
													</td>
													<td>#P-00016</td>
													<td>29/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Garrett</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-016</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox18" required="">
															<label class="form-check-label" for="customCheckBox18"></label>
														</div>
													</td>
													<td>#P-00017</td>
													<td>25/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-017</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox19" required="">
															<label class="form-check-label" for="customCheckBox19"></label>
														</div>
													</td>
													<td>#P-00018</td>
													<td>26/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Rhona</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-018</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox20" required="">
															<label class="form-check-label" for="customCheckBox20"></label>
														</div>
													</td>
													<td>#P-00019</td>
													<td>28/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Rhona</td>
													<td>Cold & Flu</td>
													<td>
														<span class="badge light badge-danger">
															<i class="fa fa-circle text-danger me-1"></i>
															New Patient
														</span>
													</td>
													<td>AB-019</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="form-check custom-checkbox ms-2">
															<input type="checkbox" class="form-check-input" id="customCheckBox21" required="">
															<label class="form-check-label" for="customCheckBox21"></label>
														</div>
													</td>
													<td>#P-00020</td>
													<td>25/02/2020, 12:42 AM</td>
													<td>Sonya Frost</td>
													<td>Dr. Garrett</td>
													<td>Sleep Problem</td>
													<td>
														<span class="badge light badge-warning">
															<i class="fa fa-circle text-warning me-1"></i>
															In Treatment
														</span>
													</td>
													<td>AB-020</td>
													<td>
														<div class="dropdown ms-auto text-end c-pointer">
															<div class="btn-link" data-bs-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="#">Accept Patient</a>
																<a class="dropdown-item" href="#">Reject Order</a>
																<a class="dropdown-item" href="#">View Details</a>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									</div>
								</div>

								<div class="tab-pane fade " id="leftPosition-html" role="tabpanel" aria-labelledby="home-tab-4">
									<div class="card-body pt-0 p-0 code-area">
<pre class="mb-0"><code class="language-html">&lt;div class="table-responsive"&gt;
&lt;table id="example5" class="display table" style="min-width: 845px"&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th&gt;
				&lt;div class="custom-control d-inline custom-checkbox"&gt;
					&lt;input type="checkbox" class="form-check-input" id="checkAll" required=""&gt;
					&lt;label class="form-check-label" for="checkAll"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/th&gt;
			&lt;th&gt;Patient ID&lt;/th&gt;
			&lt;th&gt;Date Check in&lt;/th&gt;
			&lt;th&gt;Patient Name&lt;/th&gt;
			&lt;th&gt;Doctor Assgined&lt;/th&gt;
			&lt;th&gt;Disease&lt;/th&gt;
			&lt;th&gt;Status&lt;/th&gt;
			&lt;th&gt;Room no&lt;/th&gt;
			&lt;th&gt;Action&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tbody&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox2" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox2"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00001&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Tiger Nixon&lt;/td&gt;
			&lt;td&gt;Dr. Cedric&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-001&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox3" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox3"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00002&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Garrett Winters&lt;/td&gt;
			&lt;td&gt;Dr. Cedric&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-002&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox4" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox4"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00003&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Ashton Cox&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-success"&gt;
					&lt;i class="fa fa-circle text-success me-1"&gt;&lt;/i&gt;
					Recovered
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-003&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox5" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox5"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00004&lt;/td&gt;
			&lt;td&gt;29/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Ashton Cox&lt;/td&gt;
			&lt;td&gt;Dr. Cedric&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-004&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox6" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox6"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00005&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Ashton Cox&lt;/td&gt;
			&lt;td&gt;Dr. Cedric&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-005&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox7" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox7"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00006&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Ashton Cox&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-006&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox8" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox8"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00007&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-007&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox9" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox9"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00008&lt;/td&gt;
			&lt;td&gt;29/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Dr. Garrett &lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-008&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox10" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox10"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00009&lt;/td&gt;
			&lt;td&gt;25/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-009&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox11" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox11"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00010&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-010&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox12" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox12"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00011&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Airi Satou&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-011&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox13" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox13"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00012&lt;/td&gt;
			&lt;td&gt;29/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Garrett&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-012&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox14" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox14"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00013&lt;/td&gt;
			&lt;td&gt;25/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-013&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox15" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox15"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00014&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Garrett&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-014&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox16" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox16"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00015&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-015&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox17" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox17"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00016&lt;/td&gt;
			&lt;td&gt;29/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Garrett&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-016&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox18" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox18"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00017&lt;/td&gt;
			&lt;td&gt;25/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-017&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox19" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox19"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00018&lt;/td&gt;
			&lt;td&gt;26/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-018&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox20" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox20"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00019&lt;/td&gt;
			&lt;td&gt;28/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Rhona&lt;/td&gt;
			&lt;td&gt;Cold & Flu&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-danger"&gt;
					&lt;i class="fa fa-circle text-danger me-1"&gt;&lt;/i&gt;
					New Patient
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-019&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;
				&lt;div class="form-check custom-checkbox ms-2"&gt;
					&lt;input type="checkbox" class="form-check-input" id="customCheckBox21" required=""&gt;
					&lt;label class="form-check-label" for="customCheckBox21"&gt;&lt;/label&gt;
				&lt;/div&gt;
			&lt;/td&gt;
			&lt;td&gt;#P-00020&lt;/td&gt;
			&lt;td&gt;25/02/2020, 12:42 AM&lt;/td&gt;
			&lt;td&gt;Sonya Frost&lt;/td&gt;
			&lt;td&gt;Dr. Garrett&lt;/td&gt;
			&lt;td&gt;Sleep Problem&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="badge light badge-warning"&gt;
					&lt;i class="fa fa-circle text-warning me-1"&gt;&lt;/i&gt;
					In Treatment
				&lt;/span&gt;
			&lt;/td&gt;
			&lt;td&gt;AB-020&lt;/td&gt;
			&lt;td&gt;
				&lt;div class="dropdown ms-auto text-end"&gt;
					&lt;div class="btn-link" data-bs-toggle="dropdown"&gt;
						&lt;svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;&lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;&lt;rect x="0" y="0" width="24" height="24"&gt;&lt;/rect&gt;&lt;circle fill="#000000" cx="5" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="12" cy="12" r="2"&gt;&lt;/circle&gt;&lt;circle fill="#000000" cx="19" cy="12" r="2"&gt;&lt;/circle&gt;&lt;/g&gt;&lt;/svg&gt;
					&lt;/div&gt;
					&lt;div class="dropdown-menu dropdown-menu-end"&gt;
						&lt;a class="dropdown-item" href="#"&gt;Accept Patient&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;Reject Order&lt;/a&gt;
						&lt;a class="dropdown-item" href="#"&gt;View Details&lt;/a&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
</code></pre>
								</div>
								</div>
							</div>
							<!-- /tab-content -->

                        </div>
                    </div>
                    <!-- Column ends -->
				</div>
				</div>
					<div class="demo-right ">
						<div class="demo-right-inner" id="right-sidebar">
							<h4 class="title">Datatabls</h4>
							<div class="dz-scroll demo-right-tabs" id="rightSidebarScroll">
								<ul class="navbar-nav nav" id="menu-bar">
									<li><a href="#accordion-one" 	class="scroll ">Basic Datatable</a></li>
									<li><a href="#accordion-two"	class="scroll ">Datatable</a></li>
									<li><a href="#accordion-three"	class="scroll ">Profile Datatable</a></li>
									<li><a href="#accordion-four" 	class="scroll ">Fees Collection</a></li>
									<li><a href="#accordion-five" 	class="scroll ">Patient</a></li>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
@push('scripts')
<script>hljs.highlightAll();
    hljs.configure({ ignoreUnescapedHTML: true })

    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('pre code').forEach((el) => {
            hljs.highlightElement(el);
        });
        });
</script>
@endpush
