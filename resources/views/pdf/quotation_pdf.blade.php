<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{__('Quotation')}} _{{$quotation->reference }}</title>
      <link rel="stylesheet" href="{{asset('/print/pdfStyle.css')}}" media="all" />
   </head>

   <body>
      <header class="clearfix">
         <div id="logo">
         <img src="{{asset('/images/'.$setting['logo'])}}">
         </div>
         <div id="company">
            <div><strong> Date: </strong>{{$quotation->date }}</div>
            <div><strong> Numéro: </strong> {{$quotation->reference }}</div>
         </div>
         <div id="Title-heading">
            {{__('Quotation')}}  : {{$quotation->reference}}
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
                           <div><strong>Nom :</strong> {{$quotation->client_name }}</div>
                           <div><strong>ICE :</strong> {{$quotation->client_ice }}</div>
                           <div><strong>Téle :</strong> {{$quotation->client_phone }}</div>
                           <div><strong>Adresse</strong>   {{$quotation->client_adr }}</div>
                           <div><strong>Email :</strong>  {{$quotation->client_email }}</div>
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
                           <div><strong>{{ __('Tax number') }}</strong> {{ settings()->company_tax }}</div>
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
                     <th>PODUIT</th>
                     <th>PRIX UNITAIRE</th>
                     <th>QUANTITE</th>
                     <th>REMISE</th>
                     <th>TAXE</th>
                     <th>TOTAL</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($details as $detail)
                  <tr>
                     <td>
                        <span>{{$detail->code}} ({{$detail->name}})</span>
                           @if($detail['is_imei'] && $detail['imei_number'] !==null)
                              <p>IMEI/SN : {{$detail['imei_number }}</p>
                           @endif
                     </td>
                     <td>{{$detail->unit_price}} </td>
                     <td>{{$detail->quantity}}/{{$detail['unitSale }}</td>
                     <td>{{$detail['DiscountNet }} </td>
                     <td>{{$detail['taxe }} </td>
                     <td>{{$detail->total_amount}} </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <div id="total">
            <table>
               <tr>
                  <td>Taxe de commande</td>
                  <td>{{$quotation->TaxNet }} </td>
               </tr>
               <tr>
                  <td>Remise</td>
                  <td>{{$quotation->discount }} </td>
               </tr>
               <tr>
                  <td>Livraison</td>
                  <td>{{$quotation->shipping }} </td>
               </tr>
               <tr>
                  <td>{{__('Total')}}</td>
                  <td>{{$symbol}} {{$quotation->GrandTotal }} </td>
               </tr>
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
