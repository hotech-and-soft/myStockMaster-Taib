<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{__('Payment')}}_{{$payment['reference']}}</title>
      <link rel="stylesheet" href="{{asset('/print/pdfStyle.css')}}" media="all" />
   </head>

   <body>
      <header class="clearfix">
         <div id="logo">
         <img src="{{asset('/images/'.$setting['logo'])}}">
         </div>
         <div id="company">
            <div><strong> {{__('Date')}}: </strong>{{$payment['date']}}</div>
            <div><strong> {{__('Number')}}:  </strong> {{$payment['reference']}}</div>
         </div>
         <div id="Title-heading">
           Paiement  : {{$payment['reference']}}
         </div>
         </div>
      </header>
      <main>
         <div id="details" class="clearfix">
            <div id="client">
               <table class="table-sm">
                  <thead>
                     <tr>
                        <th class="desc">{{__('Customer Info')}}</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div><strong>Nom:</strong> {{$payment['client_name']}}</div>
                           <div><strong>Téle:</strong> {{$payment['client_phone']}}</div>
                           <div><strong>Adresse:</strong>   {{$payment['client_adr']}}</div>
                           <div><strong>{{__('Email')}}:</strong>  {{$payment['client_email']}}</div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div id="invoice">
               <table  class="table-sm">
                  <thead>
                     <tr>
                        <th class="desc">{{__('Company Info')}}</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div id="comp">{{settings()->company_name}}</div>
                           <div><strong>Adresse:</strong>  {{settings()->company_address}}</div>
                           <div><strong>Téle:</strong>  {{settings()->company_phone}}</div>
                           <div><strong>{{__('Email')}}:</strong>  {{settings()->company_email}}</div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div id="details_inv">
            <table class="table-sm">
               <thead>
                  <tr>
                     <th>{{__('Sale')}}</th>
                     <th>{{__('Paid By')}}</th>
                     <th>{{__('Amount')}}</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>{{$payment['sale_Ref']}}</td>
                     <td>{{$payment['Reglement']}}</td>
                     <td>{{$symbol}} {{$payment['montant']}} </td>
                  </tr>
               </tbody>
            </table>
         </div>
         
         <div id="signature">
            @if (settings()->invoice_footer !== null)
                <p>{{ settings()->invoice_footer }}</p>
            @endif
         </div>
      </main>
   </body>
</html>