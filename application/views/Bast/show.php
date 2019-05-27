<style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

  .img-timeline{
  max-height: 50px;
  border-radius: 50%;
  }

  /*Checkboxes styles*/
  input[type="checkbox"] { display: none; }
   
  input[type="checkbox"] + label {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 10px;
    font: 14px/20px;
    color: #000;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
  }

  input[type="checkbox"] + label:last-child { margin-bottom: 0; }

  input[type="checkbox"] + label:before {
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    border: 1px solid #6cc0e5;
    position: absolute;
    left: 0;
    top: 0;
    opacity: .6;
    -webkit-transition: all .12s, border-color .08s;
    transition: all .12s, border-color .08s;
  }

  input[type="checkbox"]:checked + label:before {
    width: 10px;
    top: -5px;
    left: 5px;
    border-radius: 0;
    opacity: 1;
    border-top-color: transparent;
    border-left-color: transparent;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
  }
</style>


<div class="col-sm-12">
  <div class="card">
  <div class="card-header">
    <h5>BAST
      <div class="form-group pull-right">
        <button class="pull-right btn btn-sm btn-danger  ircle2" data-id= "<?= $id_bast; ?>"  id="btn-delete_bast" ><i class="fa fa-trash"></i></button>
      </div>
    </h5>
  </div>
  <div class="card-body">
    <form id="formBast">
      <div class="row">

      <?php if(!empty($oldBast)) :  ?>
      <div class="col-sm-12">
        <h4><b>Previous BAST</b></h4>
        <table id="datakuBast" class="table table-responsive-sm table-striped" style="width: 100%;">
              <thead>
                
                <tr style="background:#b1ffa1;">
                  <th>No. SPK</th>
                  <th>No. BAST</th>
                  <th>BAST Date</th>
                  <th>Status</th>
                </tr>

              </thead>
              <tbody>
                <?php foreach ($oldBast as $key => $value) : ?>
                  <tr>
                    <td><a href="<?= base_url()."bast/view/".$oldBast[$key]['ID_BAST'] ?>" target="_blank"><?= $oldBast[$key]['NO_SPK'] ?></a></td>
                    <td><?= $oldBast[$key]['NO_BAST'] ?></td>
                    <td><?= $oldBast[$key]['TGL_BAST2'] ?></td>
                    <td><?= $oldBast[$key]['STATUS'] ?></td>
                  </tr>
                <?php endforeach;?>

              </tbody>
          </table>
          <br>
      </div>
     <?php endif; ?>

<div class="col-md-12">
    <div class="row">
        
            <div class="col-md-6" style="margin-bottom: 10px;">
              <label>No. BAST</label>
                <input type="text" class="form-control" id="no_bast" name="no_bast" value="<?= !empty($bast['NO_BAST']) ? $bast['NO_BAST'] : ''; ?>" readOnly placeholder="<?php if(empty($bast['NO_BAST'])) : ?>Approve BAST to get BAST number<?php endif; ?>">
            </div>
        <?php if(!empty($bast['ID_PROJECT'])) : ?>    
          
            <div class="col-md-2" style="margin-bottom: 10px;">
              <label>ID PROJECT</label>
                <input type="text" class="form-control"  value="<?= !empty($bast['ID_PROJECT']) ? $bast['ID_PROJECT'] : ''; ?>" readOnly>
            </div>

            <div class="col-md-2" style="margin-bottom: 10px;">
              <label>ID LOP</label>
                <input type="text" class="form-control"  value="<?= !empty($bast['ID_LOP']) ? $bast['ID_LOP'] : '-'; ?>" readOnly>
            </div>

            <div class="col-md-2" style="margin-bottom: 10px;">
              <label style="visibility: hidden;">View Project</label>
              <a class="btn btn-success btn-brand text-left btn-sm" href="<?= base_url().'project/show/'.$bast['ID_PROJECT'] ?>">
                <i class="fa fa-location-arrow"></i><span>View Project </span>
              </a>
            </div>
        <?php endif; ?> 
    </div>
</div>

      <?php if(!empty($bast['FILENAME'])) : ?>
        <div class="col-sm-12" style="margin-bottom: 10px;">
          <label>Document BAST</label>
            <input type="text" class="form-control" id="filename" name="filename" placeholder="MM/DD/YYYY" value="<?= !empty($bast['FILENAME']) ? $bast['FILENAME'] : ''; ?>" readOnly>
        </div>
      <?php endif; ?>
      
      <div class="col-sm-6">
          <div class="form-group">
            <label for="name">Bast Date *</label>
            <input type="hidden" name="id_bast" value="<?= $id_bast; ?>">
            <input type="hidden" name="id_project" id="id_project" value="<?= !empty($bast['ID_PROJECT']) ? $bast['ID_PROJECT'] : ''; ?>">
            <input type="hidden" name="id_lop" id="id_lop" value="<?= !empty($bast['ID_LOP']) ? $bast['ID_LOP'] : ''; ?>">
            <input type="hidden" name="commend" id="commend">
            <input type="text" class="form-control date-picker" id="bast_date" name="bast_date" placeholder="BAST Date" required value="<?= !empty($bast['TGL_BAST']) ? $bast['TGL_BAST2']  : ''; ?>" readOnly>
          </div>


          <div class="form-group">
            <label for="name">Partner / Subsidiary</label>
            <input type="text" name="" class="form-control" value="<?= !empty($bast['NAMA_MITRA']) ? $bast['NAMA_MITRA'] : '"'  ?> " readOnly>
          </div>

          <div class="form-group hidden">
            <label for="name">Partner</label>
            <input type="hidden" name="partner_id" id="partner_id" value="<?= !empty($bast['ID_MITRA']) ? $bast['ID_MITRA'] : '' ?>">
            <input type="hidden" name="partner_name" id="partner_name" value="<?= !empty($bast['NAMA_MITRA']) ? $bast['NAMA_MITRA']: ''; ?>">
            <select style="width: 100%;" name="partner" id="partner" class="form-control Jselect2">
                <option value="<?= !empty($bast['ID_MITRA']) ? $bast['ID_MITRA'].'"'.' selected' : '"'  ?>  " ><?= !empty($bast['NAMA_MITRA']) ? $bast['NAMA_MITRA'] : 'Select Partner'; ?></option> 
                        <?php 
                foreach ($list_partner as $key => $value) {
                    ?>
                        <option value="<?=$list_partner[$key]['KODE_PARTNER'].'||'.$list_partner[$key]['NAMA_PARTNER']?>"><?=$list_partner[$key]['NAMA_PARTNER']?></option>
                    <?php
                        }
                    ?> 
            </select>
          </div>

          

          <div class="form-group">
            <label for="name">No. <?= !empty($bast['P71']) ? 'P71' : 'SPK' ?> *</label>
            <input type="text" name="" class="form-control" value="<?= !empty($bast['NO_SPK']) ? $bast['NO_SPK'] : '"'  ?> " readOnly>
          </div>


          <div class="form-group hidden">
            <label for="name">No. SPK *</label> <label class="text-warning" id="wSPK"></label>
            <select style="width: 100%;" name="spk" id="spk" class="form-control" required readOnly>
                <option value="<?= !empty($bast['NO_SPK']) ? $bast['NO_SPK'].'"'.' selected' : '"'  ?>  " ><?= !empty($bast['NO_SPK']) ? $bast['NO_SPK'] : ''; ?></option>
            </select>
          </div>

          <div class="form-group">
            <label>Segmen *</label>
            <input type="text" style="width: 100%;" name="segmen" id="segmen" class="form-control" value="<?= $bast['SEGMENT']; ?>" readOnly>
          </div>

          <div class="form-group">
            <label for="name">Customer Name *</label>
            <input type="hidden" id="nipnas" name="nipnas" value="<?= !empty($bast['NIPNAS'])? $bast['NIPNAS'] : ''; ?>">
            <input type="hidden" id="customer" name="customer" value="<?= !empty($bast['NAMACC']) ? $bast['NAMACC'] : '' ?>" >
            <input type="text" name="customer" id="customer" class="form-control" value="<?= $bast['NAMACC']; ?>" required readOnly>
          </div>

          <div class="form-group">
            <label for="name">SPK Date *</label>
            <input type="text" class="form-control date-picker" id="spk_date" name="spk_date" placeholder="MM/DD/YYYY" required value="<?= !empty($bast['TGL_SPK']) ? $bast['TGL_SPK2'] : ''; ?>" readOnly>
          </div>

          <div class="form-group">
            <label for="name">Project Name *</label>
            <textarea id="project_name" name="project_name" rows="3" class="form-control" placeholder="Project Name" required><?= !empty($bast['PROJECT_NAME']) ? $bast['PROJECT_NAME'] : ''; ?></textarea>
          </div>

          <div class="form-group">
            <label for="name">Project Value (Before PPN 10%)*</label>
            <input type="text" class="form-control rupiah" id="value" name="value" placeholder="Project Value" required value="<?= !empty($bast['NILAI_PEKERJAAN']) ? $bast['NILAI_PEKERJAAN'] : '0';   ?>">
          </div>

          <div class="form-group">
            <label for="name">No. KL</label>
            <input type="text" class="form-control" id="kl" name="kl" placeholder="No. KL" value="<?= !empty($bast['NO_KL'])? $bast['NO_KL'] : '' ?>">
          </div>

          <div class="form-group">
            <label for="name">KL Date</label>
            <input type="text" class="form-control date-picker" id="kl_date" name="kl_date" placeholder="MM/DD/YYYY" value="<?= !empty($bast['TGL_KL2']) ? $bast['TGL_KL2'] : ''; ?>" readOnly>
          </div>
      </div>

      <div class="col-sm-6">

        <div class="form-group">
          <label for="name">BAST Value (IDR) *</label>
          <input type="text" class="form-control rupiah" id="bast_value" name="bast_value" placeholder="BAST Value" required value="<?= !empty($bast['NILAI_RP_BAST']) ? $bast['NILAI_RP_BAST'] : '0'; ?>">
        </div>

        <div class="form-group">
          <label for="name">Signer *</label>
          <select style="width: 100%;" name="signer" id="signer" class="form-control" required>
              <option disabled>Select Signer</option>
              <option value="Coordinator Project Management" <?= ((!empty($bast['PENANDA_TANGAN']))&&($bast['PENANDA_TANGAN']=='Coordinator Project Management')) ? 'selected' : ''; ?> >OSM Service Delivery DES - Sosro Hutomo Karsosoemo</option>
              <option value="Senior Expert Project Management Office 1" <?= ((!empty($bast['PENANDA_TANGAN']))&&($bast['PENANDA_TANGAN']=='Senior Expert Project Management Office 1')) ? 'selected' : ''; ?> >Senior Expert Project Management Office 1 - Ristyawan Fauzi Mubarok</option>
              <option value="Senior Expert Project Management Office 2" <?= ((!empty($bast['PENANDA_TANGAN']))&&($bast['PENANDA_TANGAN']=='Senior Expert Project Management Office 2')) ? 'selected' : ''; ?>>Senior Expert Project Management Office 2 - Heri Ikhwan Diana</option>
              <option value="Senior Expert Delivery and Integration" <?= ((!empty($bast['PENANDA_TANGAN']))&&($bast['PENANDA_TANGAN']=='Senior Expert Delivery and Integration')) ? 'selected' : ''; ?>>Senior Expert Delivery and Integration - Retno Kurniawati</option>   
          </select>
        </div>

        <div class="form-group">
            <label class="control-label ">Payment Scheme *</label>
            <select style="width: 100%;" name="type_bast" id="type_bast" class="form-control" style="width: 100%;" required>
                <option value="" disabled selected>Select Type</option>
                <option value="OTC" <?= $bast['TYPE_BAST']=='OTC' ? 'selected' : ''; ?> >OTC</option>
                <option value="TERMIN" <?= $bast['TYPE_BAST']=='TERMIN' ? 'selected' : ''; ?>>TERMIN</option>
                <option value="PROGRESS" <?= $bast['TYPE_BAST']=='PROGRESS' ? 'selected' : ''; ?> >PROGRESS</option>
                <option value="RECURRING" <?= $bast['TYPE_BAST']=='RECURRING' ? 'selected' : ''; ?>>RECURRING</option>
                <option value="OTC & RECURRING" <?= $bast['TYPE_BAST']=='OTC & RECURRING' ? 'selected' : ''; ?>>OTC & RECURRING</option>
            </select>
        </div>

        <div id="progress_periode" class="form-group">
          <label class="control-label">Periode Progress Reccuring</label>
            <div class="input-daterange input-group">
              <input type="text" class="form-control date-picker" name="recc_start_date" placeholder="mm/dd/yyyy" value="<?= !empty($bast['RECC_START_DATE']) ? $bast['RECC_START_DATE2'] : ''; ?>">
                <span class="input-group-addon" style="color:#000;">&nbsp;&nbsp; to &nbsp;&nbsp;</span>
                <input type="text" class="form-control date-picker" name="recc_end_date" placeholder="mm/dd/yyyy" value="<?= !empty($bast['RECC_END_DATE']) ? $bast['RECC_END_DATE2'] : ''; ?>">
              </div>
          </div>
  
          <div id="c_reccuring_val" class="form-group hidden">
          <label class="control-label">Reccuring Value (Rp.)</label>
              <input type="text" class="form-control rupiah" id="reccuring_val" name="reccuring_val" placeholder="Reccuring value"
              value="<?= !empty($bast['NILAI_RECCURING']) ? $bast['NILAI_RECCURING'] :'' ?>" >
          </div>

          <div class="form-group" id="c_progress_actual">
            <label for="progress_actual">Progress (%)</label>
            <input type="number" class="form-control" id="progress_actual" name="progress_actual" placeholder="Progress" value="<?= !empty($bast['PROGRESS_LAPANGAN']) ? $bast['PROGRESS_LAPANGAN'] : ''; ?>">
          </div>

          <div class="form-group hidden" id="c_termin">
            <label for="name">Termin</label>
            <input type="text" class="form-control" id="termin" name="termin" value="<?= !empty($bast['NAMA_TERMIN'])? $bast['NAMA_TERMIN'] : ''; ?>" placeholder="Termin Remarks">
          </div>

           <div id="evidence" class="form-group" style="margin-bottom: 7px !important">
               <label>Evidence</label>
               <div class="row">
               <div class="col-sm-2">
                 <div class="boxes">
                    <input type="checkbox" id="cP71" name="cP71" data-val="P71" <?= ((!empty($evidence[10]))&&($evidence[10]!= ' ')) ? 'checked' : '';  ?>>
                    <label for="cP71">P7-1</label>

                    <input type="checkbox" id="cSP" name="cSP" data-val="SP" <?= ((!empty($evidence[11]))&&($evidence[11]!= ' ')) ? 'checked' : '';  ?>>
                    <label for="cSP">SP</label>

                    <input type="checkbox" id="cSPK" name="cSPK" data-val="SPK" <?= ((!empty($evidence[5]))&&($evidence[5]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="cSPK">SPK</label>

                    <input type="checkbox" id="cWO" name="cWO"  data-val="WO" <?= ((!empty($evidence[6]))&&($evidence[6]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="cWO">WO</label>

                    <input type="checkbox" id="cKL" name="cKL" data-val="KL" <?= ((!empty($evidence[7]))&&($evidence[7]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="cKL">KL</label>
                  </div>
               </div>

               <div class="col-sm-10">
                 <div class="boxes">

                    <input type="checkbox" id="Baut" name="Baut" data-val="Baut" <?= ((!empty($evidence[9]))&&($evidence[9]!= ' ')) ? 'checked' : '';  ?>>
                    <label for="Baut" >BA Uji Terima (BAUT) / BAPP Smart Building</label>

                    <input type="checkbox" id="BAprogress2" name="BAprogress2" data-val="BAprogress2" <?= ((!empty($evidence[12]))&&($evidence[12]!= ' ')) ? 'checked' : '';  ?>>
                    <label for="BAprogress2" >Lampiran Rincian Perhitungan Progress</label>

                    <input type="checkbox" id="BAcustomer" name="BAcustomer" data-val="BAcustomer" <?= ((!empty($evidence[0]))&&($evidence[0]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="BAcustomer">BA Customer / BA Format Standar</label>

                    <input type="checkbox" id="BAperformansi" name="BAperformansi" data-val="BAperformansi" <?= ((!empty($evidence[1]))&&($evidence[1]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="BAperformansi">BA Performansi (Untuk layanan berbasis SLG)</label>

                    <input type="checkbox" id="BArekonsiliasi" name="BArekonsiliasi" data-val="BArekonsiliasi" <?= ((!empty($evidence[2]))&&($evidence[2]!= ' ')) ? 'checked' : '';  ?>  >
                    <label for="BArekonsiliasi">BA Rekonsiliasi (Untuk layanan Transaksional berbasis rekon)</label>

                    <input type="checkbox" id="BAketerlambatan" name="BAketerlambatan" data-val="BAketerlambatan" <?= ((!empty($evidence[4]))&&($evidence[4]!= ' ')) ? 'checked' : '';  ?>  >
                    <label for="BAketerlambatan" >BA Keterlambatan Delivery</label>

                    <input type="checkbox" id="BAprogress" name="BAprogress" data-val="BAprogress" <?= ((!empty($evidence[3]))&&($evidence[3]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="BAprogress" >BAPP (BA Progress Pekerjaan)</label>

                    <input type="checkbox" id="OtherE" name="OtherE" data-val="Other" class="OtherE" <?= ((!empty($evidence[13]))&&($evidence[13]!= ' ')) ? 'checked' : '';  ?> >
                    <label for="OtherE" class="OtherE" >Other</label>
                    <input type="text" class="form-control <?= ((!empty($evidence[13]))&&($evidence[13]!= ' ')) ? '' : 'hidden';  ?>" name="val_other" id="val_other" placeholder="type another attached evidence" value="<?= ((!empty($evidence[13]))&&($evidence[13]!= ' ')) ? $evidence[13] : '';  ?>" >
                  
                  </div>          
               </div>
               </div>
           </div> 

          <div class="form-group hidden">
            <label for="name">Project Manager</label>
            <input type="hidden" class="form-control" id="pm_name" name="pm_name" val="<?= !empty($bast['NAMA_PM']) ? $bast['NAMA_PM'] : ''; ?>">
            <select style="width: 100%;" name="pm" id="pm" class="form-control">
                <option val="<?= !empty($bast['NIK_PM']) ? $bast['NIK_PM'] : ''; ?>"><?= !empty($bast['NIK_PM']) ? $bast['NIK_PM'] : ''; ?></option>
            </select>
          </div>

          <div class="form-group ">
            <label>Email PIC Partner / Subsidiary *</label>
            <input type="hidden" class="form-control" id="email_pic_partner2" name="email_pic_partner2">
            <select style="width: 100%;" name="email_pic_partner" id="email_pic_partner" class="form-control" val="<?= !empty($bast['EMAIL_MITRA']) ? $bast['EMAIL_MITRA'] : ''; ?>" required>
                <option val="<?= !empty($bast['EMAIL_MITRA']) ? $bast['EMAIL_MITRA'] : ''; ?>" ><?= !empty($bast['EMAIL_MITRA']) ? $bast['EMAIL_MITRA'] : ''; ?></option>
            </select>
          </div>

          <div class="form-group" id="c_pic_partner">
            <label>PIC Partner / Subsidiary *</label>
             <input type="text" class="form-control" id="pic_partner" name="pic_partner" placeholder="PIC Partner / Subsidiary"  value="<?= !empty($bast['PIC_MITRA']) ? $bast['PIC_MITRA'] : ''; ?>">
          </div>

          <input type="hidden" class="form-control" id="evidence_field" name="evidence">
      </div>


      <div id="c_document" class="row m-top-30 <?= !empty($bast['FILENAME_URI'])? '' : 'hidden' ?>">
        <div class="col-md-4 offset-md-4">
          <div class="form-group">
              <input id="document" name="file_bast" type="file" accept="pdf" class="form-control file" >
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="form-group ">
          <label><span class="text-primary">Document Status</span></label>
          <div class="input-group">
            <select name="status" id="status" class="form-control text-primary" style="height: inherit;font-size: 20px !important;">
                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='SUBMIT BY PARTNER') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <?php if($this->session->userdata('tipe_sess')!='SUBSIDIARY'): ?>
                  <option value="RECEIVED" >RECEIVED</option>
                  <?php endif; ?>
                  <?php endif; ?>    

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='RECEIVED') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY ADM" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY ADM') ? ' selected' : '' ?> >CHECK BY ADM</option>
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='TAKE OUT (REV)') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="REVISIONED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='RECEIVED') ? ' selected' : '' ?> >RECEIVED</option>
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='REVISIONED') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY ADM" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY ADM') ? ' selected' : '' ?> >CHECK BY ADM</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY ADM') :  ?>\
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY ADM" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY ADM') ? ' selected' : '' ?> >CHECK BY ADMIN</option>  
                  <option value="CHECK BY SE DI" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE DI') ? ' selected' : '' ?> >CHECK BY SE DI</option>
                  <option value="CHECK BY SE PMO" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO') ? ' selected' : '' ?> >CHECK BY SE PMO</option>   
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO' && ( $bast['PENANDA_TANGAN'] =='Senior Expert Project Management Office 1' || $bast['PENANDA_TANGAN'] =='Senior Expert Project Management Office 1' )) :   ?>  
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY SE PMO" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO') ? ' selected' : '' ?> >CHECK BY SE PMO</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>  
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO' && ( $bast['PENANDA_TANGAN'] =='Senior Expert Project Management Office 2' || $bast['PENANDA_TANGAN'] =='Senior Expert Project Management Office 2' )) :   ?>  
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY SE PMO" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO') ? ' selected' : '' ?> >CHECK BY SE PMO</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>  
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE DI' && $bast['PENANDA_TANGAN'] =='Senior Expert Delivery and Integration') :   ?> 
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY SE DI" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE DI') ? ' selected' : '' ?> >CHECK BY SE DI</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>  
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO' &&  $bast['PENANDA_TANGAN'] =='Coordinator Project Management') :   ?> 
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY SE PMO" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE PMO') ? ' selected' : '' ?> >CHECK BY SE PMO</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>  
                  <option value="CHECK BY COORD" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE COORD') ? ' selected' : '' ?> >CHECK BY COORD</option> 
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE DI' &&  $bast['PENANDA_TANGAN'] =='Coordinator Project Management') :   ?>  
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY SE DI" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE DI') ? ' selected' : '' ?> >CHECK BY SE DI</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>  
                  <option value="CHECK BY COORD" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE COORD') ? ' selected' : '' ?> >CHECK BY COORD</option> 
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 


                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY COORD') :  ?>  
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY COORD" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY SE COORD') ? ' selected' : '' ?> >CHECK BY COORD</option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>    
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?> 

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="APPROVED" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='APPROVED') ? ' selected' : '' ?> >APPROVED</option>
                  <option value="DONE" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='DONE') ? ' selected' : '' ?> >DONE</option>
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?>

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='DONE') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="DONE" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='DONE') ? ' selected' : '' ?> >DONE</option>
                  <option value="TAKE OUT" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='TAKE OUT') ? ' selected' : '' ?> >TAKE OUT</option>
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?>

                  
                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="CHECK BY ADM" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='CHECK BY ADM') ? ' selected' : '' ?> >CHECK BY ADM</option>
                  <option value="TAKE OUT (REV)" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='TAKE OUT') ? ' selected' : '' ?> >TAKE OUT</option>
                  <?php endif; ?>

                  <?php if(!empty($bast['STATUS'])&&$bast['STATUS']=='TAKE OUT') :  ?>
                  <option value="<?= $bast['STATUS']; ?>" style="color:#000 !important;"><?= $bast['STATUS']; ?></option>
                  <option value="REVISION" <?= (!empty($bast['STATUS'])&&$bast['STATUS']=='REVISION') ? ' selected' : '' ?> >REVISION</option>
                  <?php endif; ?>
            </select>
            <span class="input-group-append">
              <button class="btn btn-success btn-sm" id="btn_update" type="button"><i class="fa fa-play-circle"></i>
                 <span>&nbsp; Update</span>
              </button>
            </span>
          </div>
        </div>

        <div class="form-group hidden" id="c_revision_symptoms">
          <label>Symptoms Revision</label>
          <select multiple="true" class="form-control Jselect2" name="revision_symptoms[]" id="revision_symptoms">
            <option value="Typo Penulisan"><i>Typo</i> Penulisan</option>
            <option value="Salah Penanggalan">Salah Penanggalan</option>
            <option value="Salah Jabatan">Salah Jabatan</option>
            <option value="Revisi Wording">Revisi <i>Wording</i></option>
            <option value="Tidak ada BAUT">Tidak ada <i>BAUT</i> / Lampiran <i>BAUT</i></option>
            <option value="Tidak ada surat target delivery dari SEGMEN">Tidak ada surat target delivery dari SEGMEN</option>
            <option value="Dokumen Evidence tidak valid">Dokumen Evidence tidak valid</option>
            <option>Others</option>
          </select>
        </div>
      </div>

     
    </form>


      <div class="col-sm-12">
          <label><strong>History Approval</strong></label>
          <?php if(!empty($history)) : ?>
              <?php foreach($history as $key=>$value) :?>
                

              <div class="row">   
              <!-- timeline item 1 left dot -->
                  <div class="col-auto text-center flex-column d-none d-sm-flex"  >
                    <div class="row h-50">
                      <div class="col">&nbsp;</div>
                      <div class="col">&nbsp;</div>
                    </div>
                    <h5 class="m-2">
                      <span class="badge badge-pill bg-light border">&nbsp;</span>
                    </h5>
                    <div class="row h-50">
                      <div class="col border-right">&nbsp;</div>
                      <div class="col">&nbsp;</div>
                    </div>
                  </div>
                  <!-- timeline item 1 event content -->
                  <div class="col py-2">
                    <div class="card">
                      <div class="card-body">
                          <div class="float-right text-muted"><?= $history[$key]['TIME']; ?><span class="tex-muted">
                            <br><span class="text-black"><?= $history[$key]['NAME_USER']; ?></span>
                          </span>
                        </div>
                        <img class="img-timeline" src="<?= !empty($history[$key]['PHOTO_USER']) ? $history[$key]['PHOTO_USER'] : base_url().'assets/img/avatars/default.png';?>" alt="">
                        <p class="card-text"><strong><?= $history[$key]['STATUS']; ?></strong></p>
                        <p class="card-text"><?= $history[$key]['COMMEND']; ?></p>
                      </div>
                    </div>
                  </div>
              </div>
                    
              <?php endforeach; ?>
          <?php endif; ?>


        </div>

  </div>
  </div>
</div>

</div>

<!-- Project modals -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="project-modal">
  <div class="modal-dialog modal-lg modal-primary">
    <div class="modal-content">
        <div class="modal-header">
              <h4 class="modal-title" id="modal-title-partner">Add BAST for Project</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
        </div>
              <div class="modal-body relative">
                <form>             
                  <div class="input-group">
                    <input type="text" name="searchProject" id="searchProject" class="form-control" placeholder="search projects by project name / project id / no. spk(P8) / customer / partner">
                    <span class="input-group-append">
                    <button id="btnSearchProject" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    <!-- <button id="btnClearSearchProject" class="btn btn-secondary btn-warning" type="button"><i class="fa fa-trash"></i> Clear</button> -->
                    </span>
                  </div>                                         
                    <table id="dataku7" class="table table-responsive-sm table-striped" style="width: 100% !important;">
                        <thead>
                          <tr>
                            <th style="width: 25% !important;">Project Name</th>
                            <th style="width: 10% !important;">Segmen</th>
                            <th style="width: 30% !important;">SPK / P8</th>
                            <th style="width: 15% !important;">Customer</th>
                            <th style="width: 15% !important;">Partner</th>
                            <th style="width: 5% !important;"></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> 
                  </form>
            </div>
    </div>
  </div>
</div>