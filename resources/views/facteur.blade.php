<!DOCTYPE html>
<html>

<head>
    <title>Reservation Bill</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.5;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .facteur-content {
            margin-bottom: 20px;
        }

        .facteur-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .hotel-name {
            text-align: left;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 20px;
            color: black;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .facteur-table th,
        .facteur-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .facteur-details {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .facteur-details h3 {
            margin: 0;
        }

        .facteur-details p {
            margin: 5px 0;
        }

        .facteur-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .facteur-signature {
    
    margin-bottom: 40px;
    }


    .facteur-signature p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        
    }

        .facteur-footer {
            text-align: center;
        }
    </style>
</head>

<body>
        
    <div class="hotel-name"><border>HOTERU</border></div>
    <h2>Reservation Bill</h2>

    <div class="facteur-content">

    <div class="facteur-details">
            <center><h3>Reservation Details</h3></center><br/>
            <p><strong>Reservation N°:</strong> {{ $reservation->id_reservation }}</p>
            <p><strong>Client Name:</strong> {{ $reservation->fullname }}</p>
            <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
            <p><strong>Check-in Date:</strong> {{ $reservation->date_debut  }}</p>
            <p><strong>Check-out Date:</strong> {{ $reservation->date_fin  }}</p>
           
        </div>

        <table class="facteur-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Room N°</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $reservation->type_chambre }}</td>
                    <td>{{ $reservation->prix }}</td>
                    <td>{{ $reservation->id_chambre }}</td>
                </tr>
                
                
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td><strong>{{ $reservation->total }}</strong></td>
                </tr>
            </tfoot>
        </table>

       

        
    </div>

    

    <div class="facteur-details">
    <center><h3>Hotel Information</h3></center><br/>
        <p><strong>Address:</strong> 123 Main Street, City, Country</p>
        <p><strong>Phone:</strong> +1 123-456-7890</p>
        <p><strong>Email:</strong> this.hoteru@gmail.com</p>
    </div>




    <div class="facteur-signature">
    <p style="display: inline;">Receptionist Signature:</p>
    <p style="display: inline; float: right;">Client Signature:</p>
    </div>

    <div class="facteur-footer" style="position: relative;">
    <p style="position: fixed; bottom: 0; width: 100%;">Thank you for choosing Our Hotel. We look forward to welcoming you!</p>
    </div>


    
</body>

</html>
