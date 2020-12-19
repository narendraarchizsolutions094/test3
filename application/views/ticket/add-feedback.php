<div class="row">
				 <div class="panel panel-default pt-2"> 
				<div class="panel-heading no-print" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
							<div class="row">
					<div class="col-md-12">
						<a href="<?= base_url('feedback/') ?>" class="btn btn-success"> <i class="fa fa-list"></i> Feedback List 
						</a>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>

				<div class="col-md-8 panel-default panel-body" style="border:1px solid #f7f7f7">
				
				<form action="<?= base_url('feedback/insert/') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<div class="row">

				<div id="process_basic_fields"><div class="trackingDetails"></div>                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Complaint Type</label>
                        <div>             
                          <input type="radio" name="complaint_type" value="1" checked=""> <label>Is Complaint</label>
                          <input type="radio" name="complaint_type" value="2"> <label>Is Query</label>
                        </div>
                      </div>
                    </div>
                      
                                                                                                                                             
                      
                      
                                                            <div class="col-md-6">
                          <div class="form-group">
                            <label>Referred By</label>
                            <select class="form-control select2-hidden-accessible" name="referred_by" data-select2-id="4" tabindex="-1" aria-hidden="true">
                              <option value="1" data-select2-id="6">Consignee</option><option value="2">Consignor</option><option value="3">Internal</option>                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: 338px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-referred_by-9q-container"><span class="select2-selection__rendered" id="select2-referred_by-9q-container" role="textbox" aria-readonly="true" title="Consignee">Consignee</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                                                                                                                         
                      
                      
                                                                               
                   <script type="text/javascript">
                    $("input[name=complaint_type]").on('change',function(){
                        var x = $("input[name=complaint_type]:checked").val();
                        if(x=='1')
                        {
                          $('input[name=tracking_no]').attr("required","required");
                          $('select[name=relatedto]').attr("required","required");
                          $(".opt").show();
                        }
                        else if(x=='2')
                        {
                          $('input[name=tracking_no]').removeAttr("required");
                          $('select[name=relatedto]').removeAttr("required");
                          $(".opt").hide();
                        }
                    });

                    
                    function loadTracking(that)
                      { //alert(key);
                        if(that.value=='')
                        {

                        }else{
                          $.ajax({
                            url:'https://v-trans.thecrm360.com/new_crm/ticket/view_tracking',
                            type:'post',
                            data:{trackingno:that.value},
                            beforeSend:function(){

                              $(that).parents('form').find('input,select,button').attr('disabled','disabled');
                            },
                            success:function(q)
                            { $(that).parents('form').find('input,select,button').removeAttr('disabled');
                              if(q!='0')
                                $(".trackingDetails").html(q);
                              else
                              {
                                Swal.fire({
                                            title: 'GC. No. Not Found!',
                                            cancelButtonText: 'Ok!'
                                            });
                              }
                            },
                            error:function(u,v,w)
                            {
                              console.info(w);
                            }
                          });
                          tracking_no_check(that.value);
                        }
                      }

                      function match_previous(tracking_no)
                      { 
                        if(tracking_no=='')
                        {

                        }else{
                          
                          $.ajax({
                            url:'https://v-trans.thecrm360.com/new_crm/ticket/view_previous_ticket',
                            type:'post',
                            data:{tracking_no:tracking_no},
                            beforeSend:function(){

                              
                            },
                            success:function(q)
                            { 
                              if(q!='0')
                              {
                                $("#old_ticket").show(500);
                                $(".old_ticket_data").html(q);
                              }
                              
                              //  $(that).parents('form').find('input,select,button').removeAttr('disabled');
                              //$(".trackingDetails").html(q);
                            },
                            error:function(u,v,w)
                            {
                              console.info(w);
                            }
                          });
                        }
                      }


                  </script>
          

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>GC No. <i class="text-danger opt">*</i>
                                                    
                             <a href="http://203.112.143.175/ecargont/" target="_blank" class="float-right"><u> Go To Ecargo </u></a>
                                                    </label>
                        <input type="text" name="tracking_no" class="form-control" onblur="loadTracking(this),match_previous(this.value)" required="">
                      </div>
                    </div>

                                                                                                   
                      
                      
                                                                                                    <div class="col-md-6" id="client_div">
                      <div class="form-group">
                        <label>Organization Name  </label>
                        <select class="form-control  choose-client select2-hidden-accessible" name="client" id="client" data-select2-id="client" tabindex="-1" aria-hidden="true">
                          <option value="" style="display:none;" data-select2-id="8">---Select---</option>
                          <option value="1">govt.polytechnic college , khirsadoh </option><option value="2">Biggies Burger </option><option value="4">Om Technical </option><option value="11">abhirapharmpvtltd </option><option value="14">Raj Enterprises </option><option value="21">Accutech Engineers </option><option value="23">Chheda Dyes And Chemical Co </option><option value="24">Rahi Travels </option><option value="28">Marie Triber Kitchne </option><option value="29">SP Enterprises </option><option value="42">REITZ INDIA LIMITED  </option><option value="48">TEST </option><option value="51">Shreeji Chemicals </option><option value="53">HEM INDUSTRIES  </option><option value="56">Tata Teleservices Ltd. </option><option value="57">M/s Guru Traders </option><option value="58">AVWM </option><option value="62">Maa Vaishno Enterprises </option><option value="64">Click2Eat Savouries LLP </option><option value="69">Arpan Fashions </option><option value="72">archizsolution </option><option value="75">Archiz TEST </option><option value="77">Karma </option>                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="7" style="width: 338px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-client-container"><span class="select2-selection__rendered" id="select2-client-container" role="textbox" aria-readonly="true" title="---Select---">---Select---</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <i class="fa fa-plus" id="addmoreorg" onclick="add_more_org('add_more_org')" style="float:right;margin-top:-23px;margin-right:10px;color:red;position:relative;"></i>
                      </div>
                    </div>

                   
                                                                               
                      
                      
                                                                                                                      <div class="col-md-6">
                      <div class="form-group">
                        <label>Name <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="name" required="">
                      </div>
                    </div>
                   
                                                               
                      
                      
                                                                                                                                           <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone <i class="text-danger">*</i></label>
                          <input type="text" class="form-control" name="phone" required="" value="" onkeyup="autoFill('phone',this.value)"> 
                          <div id="is-avl-mobile"></div>
                        </div>
                    </div>                   
                                          
                      
                      
                                                                                                                                                              
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="email" onblur="autoFill('email',this.value)" required="">
                      </div>
                    </div>
                   
                       
                      
                      
                                                                                                                                            
                          
                    
                                            <div class="col-md-6">
                          <div class="form-group">
                            <label>Product</label>
                            <select class="form-control  chg-product select2-hidden-accessible" name="product" data-select2-id="9" tabindex="-1" aria-hidden="true">
                              <option value="153" data-select2-id="11">FTL </option><option value="154">PTL </option>                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="10" style="width: 338px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-product-vk-container"><span class="select2-selection__rendered" id="select2-product-vk-container" role="textbox" aria-readonly="true" title="FTL ">FTL </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                          </div>
                        </div>
                        
                      
                      
                                                                                                                                            
                      
                          
                   
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Failure Point<i class="text-danger opt">*</i></label>
                          <select class="form-control  select2-hidden-accessible" name="relatedto" required="" data-select2-id="12" tabindex="-1" aria-hidden="true">
                          <option value="" data-select2-id="14">Select Subject</option>
                        <option value="1">SARANGPUR </option><option value="2">GANDHINAGAR </option><option value="3">HIMATNAGAR </option><option value="4">NADIAD </option><option value="5">KATHWADA </option><option value="6">SARKHEJ </option><option value="7">CHANGODAR </option><option value="8">SANTEJ </option><option value="9">SANAND </option><option value="10">CHHATRAL (N.G.) </option><option value="11">KALOL (N.G.) </option><option value="12">SIDHPUR </option><option value="13">MEHSANA (N.G.) </option><option value="14">KOTA (RAJASTAN) </option><option value="15">ABU ROAD </option><option value="16">BIKANER </option><option value="17">BHILWARA </option><option value="18">ASLALI BRANCH </option><option value="19">UGD SARKHEJ </option><option value="20">TRANSPORT NAGAR JAIPUR </option><option value="21">JAIPUR </option><option value="22">AJMER </option><option value="23">JODHPUR </option><option value="24">UDAIPUR </option><option value="25">AHMEDABAD REGION ADDRESS : </option><option value="26">ALWAR </option><option value="27">PALI </option><option value="28">SITAPURA - JAIPUR </option><option value="29">DHOLKA </option><option value="30">BAGRU-JAIPUR </option><option value="31">GOBLEJ BKG &amp; DLY </option><option value="32">NAROL </option><option value="33">VATVA </option><option value="34">ODHAV </option><option value="35">RAKHIAL </option><option value="36">NARODA </option><option value="37">PALANPUR </option><option value="38">SURENDRANAGAR </option><option value="39">DELHI HIGHWAY (JAIPUR) DLY </option><option value="40">DAMAN </option><option value="41">SILVASSA </option><option value="42">DADRA NAGAR HAVELI </option><option value="43">VAPI CENTRAL CELL </option><option value="44">VAPI DELIVERY </option><option value="45">SARIGAM </option><option value="46">UMARGAON </option><option value="47">VALSAD </option><option value="48">HAZIRA </option><option value="49">SAROLI </option><option value="50">NAVSARI </option><option value="51">UNN </option><option value="52">SURAT CITY </option><option value="53">BILIMORA </option><option value="54">ANKLESHWAR </option><option value="55">PANOLI </option><option value="56">KIM </option><option value="57">BHARUCH </option><option value="58">DAHEJ </option><option value="59">VYARA </option><option value="60">VAPI BKG </option><option value="61">PARDI </option><option value="62">SACHIN </option><option value="63">DAMAN DELIVERY </option><option value="64">SILVASSA CENTRAL CELL </option><option value="65">SOUTH GUJARAT REGION ADDRESS : </option><option value="66">JHAGADIA </option><option value="67">PALSANA </option><option value="68">MUMBAI </option><option value="69">BHIWANDI </option><option value="70">ANDHERI </option><option value="71">VASAI EAST </option><option value="72">BHANDUP </option><option value="73">SAKINAKA </option><option value="74">RABALE </option><option value="75">KALAMBOLI </option><option value="76">THANA </option><option value="77">KHOPOLI </option><option value="78">AMBERNATH </option><option value="79">DRONAGIRI </option><option value="80">DOMBIVLI </option><option value="81">VASHI </option><option value="82">UGD BHIWANDI </option><option value="83">PALGHAR </option><option value="84">DAPODA </option><option value="85">WADA </option><option value="86">TALOJA </option><option value="87">VADPE </option><option value="88">MURBAD </option><option value="89">DAHANU </option><option value="90">MAHAPE </option><option value="91">CCI PANVEL </option><option value="92">PATALGANGA </option><option value="93">MIRA ROAD </option><option value="94">VASIND </option><option value="95">VASAI HIGHWAY </option><option value="96">VLONAD </option><option value="97">NERUL </option><option value="98">WADALA - MUMBAI </option><option value="99">V FUCHS </option><option value="100">GENESIS </option><option value="101">PIMPLAS </option><option value="102">GOREGOAN </option><option value="103">BOISAR </option><option value="104">BELGAUM </option><option value="105">LALBAGH ROAD </option><option value="106">DODDABALLAPUR - BNG </option><option value="107">RAJAJINAGAR </option><option value="108">DAVANAGERE </option><option value="109">HUBLI INDL AREA </option><option value="110">PEENYA </option><option value="111">HOSUR </option><option value="112">BOMMASANDRA </option><option value="113">MANGALORE </option><option value="114">TUMKUR </option><option value="115">HINDUPUR </option><option value="116">HOSUR INDUSTRIAL AREA </option><option value="117">K R PURAM </option><option value="118">UDUPI </option><option value="119">BELLARY </option><option value="120">UGD SOUTH </option><option value="121">SHIVAJINAGAR-BNG </option><option value="122">KAMAKSHIPALYA-BNG </option><option value="123">JIGANI </option><option value="124">NELAMANGALA (BKG &amp; DLY) </option><option value="125">HOSPET </option><option value="126">KANAKAPURA ROAD - BNG </option><option value="127">DEEPANJALI NAGAR </option><option value="128">SIDDAIAH ROAD -BNG </option><option value="129">SHIMOGA </option><option value="130">HOSKOTE </option><option value="131">GULBARGA </option><option value="132">HUBLI – TARIHAL </option><option value="133">HASSAN </option><option value="134">CHIKMAGALUR </option><option value="135">CHITRADURGA </option><option value="136">RAICHUR </option><option value="137">BIJAPUR </option><option value="138">SINDHNOOR </option><option value="139">GADAG </option><option value="140">KOPPAL </option><option value="141">BIDAR </option><option value="142">KARWAR </option><option value="143">RAMANAGARA </option><option value="144">GANGAVATI </option><option value="145">BAIKAMPADY - MNG </option><option value="146">SIRSI </option><option value="147">RABAKAVI - BANATTI </option><option value="148">MANDYA </option><option value="149">BAGALAKOTE - NORTH KAR </option><option value="150">BELGAUM INDL ESTATE </option><option value="151">KUSHALNAGAR – KODAGU </option><option value="152">BHATKAL </option><option value="153">KUMTA </option><option value="154">HUBLI CITY </option><option value="155">BOMMANAHALLI - BNG </option><option value="156">NELAMANGALA CENTRAL CELL </option><option value="157">GOKAK </option><option value="158">DABASPET </option><option value="159">BIDADI </option><option value="160">TUMKUR INDUSTRIAL AREA </option><option value="161">BUDIHAL-TUMKUR ROAD </option><option value="162">PUTTUR </option><option value="163">MYSORE - INDUSTRIAL AREA </option><option value="164">KUPPAM </option><option value="165">KUNDAPUR </option><option value="166">KOLAR </option><option value="167">MALUR </option><option value="168">RANEBENNUR </option><option value="169">MYSORE </option><option value="170">HAROHALLI - BANGALORE </option><option value="171">MACHHE INDUSTRIAL </option><option value="172">HOSUR SIPCOT 2 </option><option value="173">DUNDAHERA </option><option value="174">CHANDIGARH FR </option><option value="175">JALANDHAR FR </option><option value="176">AMBALA CITY </option><option value="177">LUDHIANA </option><option value="178">PARWANOO </option><option value="179">BADDI (HIMACHAL PRADESH) </option><option value="180">AMRITSAR </option><option value="181">KUNDLI FR </option><option value="182">DELHI (RAMA ROAD) </option><option value="183">PANIPAT </option><option value="184">OKHLA-1 </option><option value="185">MANESAR </option><option value="186">FARIDABAD FR </option><option value="187">NARELA </option><option value="188">FARIDABAD </option><option value="189">MUNDKA </option><option value="190">BHIWADI - RAJASTHAN </option><option value="191">UGD NORTH </option><option value="192">NALAGARH </option><option value="193">KALA-AMB </option><option value="194">JAMMU </option><option value="195">SONEPAT </option><option value="196">SGTN-DELHI </option><option value="197">GURGAON BKG &amp; DLY </option><option value="198">ZIRAKPUR </option><option value="199">DELHI EAST </option><option value="200">NARAINA </option><option value="201">ROSHANARA ROAD </option><option value="202">BAHADURGARH </option><option value="203">BABARPUR </option><option value="204">MAYAPURI </option><option value="205">UNA - HP </option><option value="206">GGN FARUKNAGAR </option><option value="207">PATIALA </option><option value="208">KAMLA MARKET </option><option value="209">CHANDIGARH BRANCH </option><option value="210">JAGADHRI </option><option value="211">BAWAL </option><option value="212">SAMEYPUR (MANGOLPURI) </option><option value="213">BAWANA </option><option value="214">NANGLOI FR </option><option value="215">SHAHDRA </option><option value="216">SOLAN </option><option value="217">BASAI - GGN </option><option value="218">TIKRI BORDER </option><option value="219">DHARUHERA FR </option><option value="220">HISAR </option><option value="221">KHUSHKHERA </option><option value="222">KUNDLI BRANCH </option><option value="223">GGN-WAZIRPUR </option><option value="224">CHANDNI CHOWK </option><option value="225">BIJWSAN </option><option value="226">YAMUNANAGAR </option><option value="227">SRINAGAR </option><option value="228">GGNDLY </option><option value="229">SAMPLA </option><option value="230">TRONICA CITY </option><option value="231">KAITHAL </option><option value="232">KARNAL </option><option value="233">NEEMRANA </option><option value="234">ROHTAK </option><option value="235">CHAKAN </option><option value="236">WAGHOLI </option><option value="237">PIRANGUT </option><option value="238">PONDA </option><option value="239">MADGAON </option><option value="240">GONDHE </option><option value="241">SINNER </option><option value="242">AURANGABAD (WALUJ) MIDC </option><option value="243">VERNA-GOA </option><option value="244">AURANGABAD CITY- CHIKALTHANA </option><option value="245">LOTE </option><option value="246">PUNE CITY </option><option value="247">ROHA </option><option value="248">KOLHAPUR </option><option value="249">KARAD </option><option value="250">MAPUCA </option><option value="251">SATARA </option><option value="252">NASIK </option><option value="253">PHURSUNGHI </option><option value="254">AHEMADNAGAR </option><option value="255">MAHAD MIDC </option><option value="256">NIGDI </option><option value="257">RANJANGAON </option><option value="258">SHIRVAL </option><option value="259">JALGAON </option><option value="260">SANGLI </option><option value="261">SINHAGAD ROAD </option><option value="262">KHED SHIVAPUR </option><option value="263">TALEGAON (BKG &amp; DLY) </option><option value="264">RATNAGIRI </option><option value="265">HINJEWADI </option><option value="266">HADAPSAR </option><option value="267">SANASWADI </option><option value="268">BARAMATI </option><option value="269">DHULE </option><option value="270">SOLAPUR CITY </option><option value="271">ICHALKARANJI </option><option value="272">TEMBHURNI </option><option value="273">KURKUMBH </option><option value="274">MALEGAON </option><option value="275">LATUR </option><option value="276">JALNA </option><option value="277">KAGAL </option><option value="278">SUPA MIDC </option><option value="279">KHALUMBRE - CHAKAN </option><option value="280">CHAKAN CENTRAL CELL </option><option value="281">NANDED </option><option value="282">SHINOLI </option><option value="283">PHURSUNGI DELIVERY </option><option value="284">LONAND - KHANDALA </option><option value="285">LONIKAND </option><option value="286">SOLAPUR </option><option value="287">LONAVALA </option><option value="288">TRAJPAR (MORBI) </option><option value="289">JUNAGADH-SABALPUR </option><option value="290">METODA </option><option value="291">MORBI </option><option value="292">JAMNAGAR - SHANKARTEKRI </option><option value="293">NAVAGAM (BVR) </option><option value="294">SIHOR </option><option value="295">JETPUR </option><option value="296">SHAPAR </option><option value="297">JAMNAGAR </option><option value="298">BHAKTINAGAR </option><option value="299">BHAVNAGAR </option><option value="300">GANDHIDHAM </option><option value="301">GANDHIDHAM CITY </option><option value="302">MANDVI </option><option value="303">RUDANAGAR BRANCH </option><option value="304">VAVDI-RAJKOT </option><option value="305">UGD RAJKOT </option><option value="306">PORBANDAR </option><option value="307">GONDAL </option><option value="308">PIPAVAV </option><option value="309">ATIKA (RAJKOT) </option><option value="310">VERAVAL </option><option value="311">THANGADH </option><option value="312">MAHUVA </option><option value="313">DARED </option><option value="314">BHUJ </option><option value="315">MUNDRA </option><option value="316">GUINDY-CHENNAI </option><option value="317">BROADWAY - CHENNAI </option><option value="318">PONDICHERRY </option><option value="319">MADHAVRAM </option><option value="320">AMBATTUR-CHENNAI </option><option value="321">GUMMIDIPOONDI - CHENNAI </option><option value="322">PERUNGUDI </option><option value="323">RANIPET </option><option value="324">SRIPERUMBUDUR </option><option value="325">MARAIMALAI NAGAR - CHE </option><option value="326">MADURAVOYIL BRANCH </option><option value="327">KANCHIPURAM </option><option value="328">PALLAVARAM - CHENNAI </option><option value="329">CUDDALORE </option><option value="330">UGD TAMILNADU </option><option value="331">ORAGADAM-CHE </option><option value="332">AMBATTUR ESTATE </option><option value="333">REDHILLS - CHENNAI </option><option value="334">VILLUPURAM </option><option value="335">MADURAVOYIL DELIVERY </option><option value="336">AMBUR </option><option value="337">THIRUVNNAMALAI </option><option value="338">PANRUTI </option><option value="339">IRUNGATTUKOTTAI </option><option value="340">ROYAPETTAH - CHENNAI </option><option value="341">SRICITY - TADA </option><option value="342">THIRUVALLUR - CHE </option><option value="343">SHOLINGHUR </option><option value="344">MANALI - CHENNAI </option><option value="345">TIRUPATTUR </option><option value="346">KOYEMBEDU - CHENNAI </option><option value="347">THIRUBHUVANAI </option><option value="348">KELAMBAKKAM </option><option value="349">NAGPUR (WADI) </option><option value="350">NAGPUR CITY </option><option value="351">CHANDRAPUR </option><option value="352">AMRAVATI </option><option value="353">RAIPUR </option><option value="354">JABALPUR </option><option value="355">BUTIBORI </option><option value="356">NAGPUR WADDHAMNA </option><option value="357">BHILAI </option><option value="358">BILASPUR </option><option value="359">KHAMGAON </option><option value="360">BHANDARA </option><option value="361">AKOLA </option><option value="362">GANDHIBAGH-NGP </option><option value="363">MALKAPUR </option><option value="364">MAKARPURA </option><option value="365">DASHRATH </option><option value="366">NANDESARI </option><option value="367">V V NAGAR </option><option value="368">PADRA (DHABASA) </option><option value="369">POR </option><option value="370">WAGHODIA </option><option value="371">GODHRA PANCHMAHAL </option><option value="372">HALOL (GIDC) </option><option value="373">DEWAS NAKA </option><option value="374">BHOPAL </option><option value="375">INDORE CITY </option><option value="376">PITHAMPUR </option><option value="377">DEWAS (TOWN) </option><option value="378">PANCHKUIA </option><option value="379">MANJUSAR </option><option value="380">UJJAIN </option><option value="381">MANDIDEEP </option><option value="382">LASUDIA </option><option value="383">GOLDEN BRANCH </option><option value="384">BARODA - KARELIBAUG </option><option value="385">VIJAYAWADA </option><option value="386">BALANAGAR </option><option value="387">HUBSIGUDA </option><option value="388">PATANCHERU </option><option value="389">GAJUWAKA </option><option value="390">DIWANDEVDI </option><option value="391">BOLLARAM </option><option value="392">JEEDIMETLA </option><option value="393">SECUNDERABAD </option><option value="394">KAKINADA </option><option value="395">KURNOOL </option><option value="396">GUNTUR </option><option value="397">MEDCHAL </option><option value="398">AUTONAGAR-HYD </option><option value="399">NELLORE </option><option value="400">BHAVANIPURAM-VJW </option><option value="401">TIRUPATHI </option><option value="402">VIZIANAGARAM </option><option value="403">RAJAHMUNDRY CITY </option><option value="404">CHERLAPALLY </option><option value="405">CHITTOOR </option><option value="406">CUDDAPAH </option><option value="407">KARIMNAGAR </option><option value="408">NIZAMABAD </option><option value="409">WARANGAL </option><option value="410">ONGOLE </option><option value="411">ANANTAPURAM </option><option value="412">KHAMMAM </option><option value="413">SRIKAKULAM </option><option value="414">BAHADURPALLY DELIVERY </option><option value="415">KOTHUR </option><option value="416">PASHAMYLARAM - HYD </option><option value="417">ACHUTHAPURAM </option><option value="418">PARAWADA </option><option value="419">GUDIVADA </option><option value="420">BAHADURPALLY BOOKING </option><option value="421">HYDERABAD CENTRAL CELL </option><option value="422">ELURU </option><option value="423">ADILABAD </option><option value="424">MADURAI </option><option value="425">SALEM </option><option value="426">TRIVANDRUM </option><option value="427">ERODE </option><option value="428">TRICHUR </option><option value="429">CALICUT </option><option value="430">TIRUPUR </option><option value="431">KARUR </option><option value="432">QUILON (KOLLAM) </option><option value="433">KOTTAYAM </option><option value="434">TUTICORIN </option><option value="435">NAGERCOIL </option><option value="436">TRICHY </option><option value="437">TIRUNELVELI </option><option value="438">SIVAKASI </option><option value="439">RAJAPALAYAM </option><option value="440">ALLEPPEY </option><option value="441">KANJIKODE </option><option value="442">COIMBATORE BRANCH </option><option value="443">KALAMASSERY </option><option value="444">KANNUR </option><option value="445">NAMAKKAL </option><option value="446">DINDIGUL </option><option value="447">KOMARAPALAYAM </option><option value="448">GANAPATHY-CBE </option><option value="449">PUDUKKOTTAI </option><option value="450">UDUMALPET </option><option value="451">NEELAMBUR </option><option value="452">SHORANUR </option><option value="453">BODINAYAKKANUR </option><option value="454">MANJERI </option><option value="455">KUMBAKONAM </option><option value="456">SIVAKASI-THIRUTHANGAL </option><option value="457">METTUPALAYAM </option><option value="458">POLLACHI </option><option value="459">TIRUPUR CITY </option><option value="460">PERUNDURAI SIPCOT </option><option value="461">MANAPPARAI - TNPL </option><option value="462">COONOOR </option><option value="463">KARUR - TNPL </option><option value="464">KARAIKAL </option><option value="465">THANJAVUR </option><option value="466">COIMBATORE - SIDCO </option><option value="467">METTUR DAM </option><option value="468">DHARMAPURI </option><option value="469">KOVILPATTI </option><option value="470">ELOOR-KERALA </option><option value="471">KOLKATA(B T ROAD) </option><option value="472">KOLKATA-SOUTH </option><option value="473">KOLKATA-CENTRAL </option><option value="474">PATNA </option><option value="475">JAMSHEDPUR </option><option value="476">RANCHI </option><option value="477">BHUBANESWAR </option><option value="478">SILIGURI </option><option value="479">GUWAHATI </option><option value="480">DURGAPUR </option><option value="481">HOWRAH </option><option value="482">CUTTACK </option><option value="483">KHARAGPUR </option><option value="484">SAMBALPUR </option><option value="485">KOLKATA TR </option><option value="486">KALYANI </option><option value="487">ALAMPUR </option><option value="488">BELILIOUS ROAD </option><option value="489">UGD KOLKATTA </option><option value="490">ROURKELA </option><option value="491">JORHAT - ASSAM </option><option value="492">KOLKATA CC </option><option value="493">DANKUNI </option><option value="494">DEOGHAR </option><option value="495">MALDA </option><option value="496">BALASORE </option><option value="497">HALDIA </option><option value="498">RANCHI DELIVERY </option><option value="499">DEHRADUN </option><option value="500">GHAZIABAD </option><option value="501">KANPUR(FR) </option><option value="502">GWALIOR </option><option value="503">AGRA </option><option value="504">NOIDA </option><option value="505">LUCKNOW </option><option value="506">RUDRAPUR </option><option value="507">HARIDWAR </option><option value="508">SAHIBABAD </option><option value="509">MEERUT </option><option value="510">ROORKEE </option><option value="511">SELAQUI </option><option value="512">KANPUR </option><option value="513">BHANGEL </option><option value="514">UPBORDER (BKG &amp; DLY) </option><option value="515">KASHIPUR </option><option value="516">SITARGANJ </option><option value="517">VARANASI </option><option value="518">SAHARANPUR </option><option value="519">MORADABAD </option><option value="520">BAREILLY </option><option value="521">GHAZIABAD FR </option><option value="522">LONI </option><option value="523">ALLAHABAD </option><option value="524">BHAGWANPUR </option><option value="525">MATHURA </option><option value="526">LAL KUAN FR </option><option value="527">MUZAFFARNAGAR </option><option value="528">MODINAGAR FR </option><option value="529">ARYAN NAGAR - GZB </option><option value="530">GORAKHPUR </option><option value="531">GAJRAULA </option><option value="532">AGRA SADAR BHATTI </option><option value="533">UNNAO </option><option value="534">BHADOHI </option><option value="535">NELAMANGALA </option><option value="536">BOMMASANDRA TR </option><option value="537">CHAKAN TR </option><option value="538">BAHADURPALLY TR </option><option value="539">BAHARAGORA </option><option value="540">BHIWANDI TR  </option><option value="541">DASHRATH TR </option><option value="542">GHAZIABAD TR </option><option value="543">GOBLEJ TC </option><option value="544">GURGAON TR </option><option value="545">HUBLI TR </option><option value="546">INDORE TR  </option><option value="547">JAIPUR TR  </option><option value="548">KANPUR TR </option><option value="549">KOLHAPUR TR </option><option value="550">MADURAVOYIL  </option><option value="551">NAGPUR TR </option><option value="552">PANCHKULA TR </option><option value="553">PHURSUNGI TR </option><option value="554">RUDANAGAR </option><option value="555">SALEM TR </option><option value="556">VAPI </option><option value="557">VIJAYAWADA TR </option><option value="558">DAMAN DELIVERY UT </option><option value="559">KRISHNAGIRI </option><option value="560">DRONAGIRI ( NAVA SEVA) </option><option value="561">PIMPLAS - BHIWANDI </option><option value="562">GENESIS PALGHAR </option><option value="563">NANJANGUD-MYSORE </option><option value="564">IDA GANDHINAGAR-HYD </option><option value="565">CHITTORGARH </option><option value="566">KUBADTHAL </option><option value="567">KOLLAM CASHEW </option><option value="568">SURAJKUND MEERUT FR </option><option value="569">JAIPUR TR </option><option value="570">BHILWARA FR </option><option value="571">INDORE TR </option><option value="572">KATHWADA TR </option><option value="573">MADURAVOYIL </option><option value="574">ALIGARH FR </option><option value="575">BHIWANDI TR </option><option value="576">FIROZABAD FR </option>                          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="13" style="width: 338px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-relatedto-wj-container"><span class="select2-selection__rendered" id="select2-relatedto-wj-container" role="textbox" aria-readonly="true" title="Select Subject">Select Subject</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                         
                   
                      
                                                                                                                                            
                      
                      
                                                                                                                                            
                      
                      
                                    
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Source</label>
                        <select class="form-control  select2-hidden-accessible" name="source" data-select2-id="15" tabindex="-1" aria-hidden="true">
                          <option value="129" data-select2-id="17">Website </option><option value="131">V-Trans </option><option value="132">Reference </option><option value="133">Cold Call </option><option value="134">Helpline Number </option><option value="135">Indiamart </option><option value="136">Email </option>                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="16" style="width: 338px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-source-zi-container"><span class="select2-selection__rendered" id="select2-source-zi-container" role="textbox" aria-readonly="true" title="Website ">Website </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>
                    </div>

                                                                                                                                            
                      
                      
                    
                   <div class="col-md-6">
                    <div class="form-group">
                      <label>Attachment</label>
                      <input type="file" name="attachment[]" class="form-control" accept=".jpg,.jpeg,.png,.pdf" multiple="">
                    </div>
                  </div>

                                                                                                                                          
                      
                      
                    
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="remark" class="form-control"></textarea>
                    </div>
                  </div>  

                   
          <script>
            $('select').select2();
            function add_more_org(type='add_more_org'){
              $("#addmoreorg").hide();                            
              $("#client").val("").trigger('change');
              html = '<div class="col-md-6"><div class="form-group"><label>'+"New Organization Name "+'</label><input type="text" name="client_new" class="form-control"></div></div>';
              $("#client_div").after(html);
              $("#client").attr('disabled',true);
              
            }
            </script></div>

				<div class="col-md-12 text-center">
					<button class="btn btn-success" type="submit" id="save_ticket">Save</button>
				</div>
			</div>
				</form>				<div class="row">
					<div class="col-md-12" id="oldticket">
					</div>
				</div>
			</div>
			</div>
			</div>
        </div>