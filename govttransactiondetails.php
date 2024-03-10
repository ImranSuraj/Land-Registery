
<?php
session_start();
$userId = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Available Properties</title>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./style.css">

  </head>
  
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark px-5 py-2  fixed-top"
  style="background-color:indigo;";>
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
          <li class="nav-item">
              <a class="nav-link text-white" href="Govt.php">LAND REGISTERY</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="logout.php">LOGOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">
              <?php
              echo "Aadhar: $userId" ;
              ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    

    <!-- <div class="p-2 text-center font-italic "
     style="font-size:20px;font-weight: 500;color:white;background-color: rgb(8 47 73);">Available Properties</div> -->
     <div class="overflow-auto" style="margin-top:70px"> 
     <table id="usersTable " border="2">
     <thead style="background-color:purple">
        <tr >
            <th  colspan="6" class="text-center">Seller Details</th>
            <th colspan="6" class="text-center">Buyer Details</th>
            <th colspan="3" class="text-center">Transaction details</th>
            <th colspan="3" class="text-center">Action</th>
        </tr>
        <tr >

          <th class="pl-3">Seller Name</th>
          <th >Seller Email</th>
          <th>Seller Phone</th>
          <th>Seller Aadhar</th>
          <th>Seller LandId</th>
          <th>Seller Account</th>
          <th>Buyer Name</th>
          <th >Buyer Email</th>
          <th> Buyer Phone</th>
          <th>Buyer Aadhar</th>
          <th> Buyer LandId</th>
          <th>Buyer Account</th>
          <th>Amount</th>
          <th>Transaction Hash</th>
		  <th>Trans Status</th>
		  <th>Trans Timestamp</th>
          <th>Ownership Status</th>
		  <th>Ownership</th>

        </tr>
      </thead>
      <tbody id="usersTableBody">
        <!-- User details will be added here dynamically -->
      </tbody>
    </table>
     </div > 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.5.2/web3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@1.3.4/dist/web3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      const contractAddress = "0x6cDDd073a7641304aBCc3eAC5F2e03879d9d0E8D";
      const abi =[
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_email",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_adhar",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_phone",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_country",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_state",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_city",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_pincode",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_ipfsHash",
				"type": "string"
			}
		],
		"name": "addUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_sellerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerLandID",
				"type": "string"
			}
		],
		"name": "changeOwnership",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			}
		],
		"name": "rejectUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_sellerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_sellerAddress",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerAddress",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_amount",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_transHash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_timestamp",
				"type": "string"
			}
		],
		"name": "sendAmount",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			}
		],
		"name": "validateUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "fetchDetails",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "sellerName",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerEmail",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerPhone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerAdhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerLandId",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "selleripfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerAddress",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerName",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerEmail",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerPhone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerAdhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerLandId",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyeripfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerAddress",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "amount",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "transaction_hash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "transactionStatus",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "timestamp",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "ownership_status",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.TransactionDetail[]",
				"name": "details",
				"type": "tuple[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getAllUsers",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "name",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "email",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "adhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "phone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "landID",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "country",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "state",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "city",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "pincode",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "ipfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "status",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.User[]",
				"name": "",
				"type": "tuple[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "owner",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"name": "ownershipStatus",
		"outputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "transactionCount",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "transactions",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "name",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "email",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "adhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "phone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "landID",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "ipfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "userAddress",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.UserInfo",
				"name": "seller",
				"type": "tuple"
			},
			{
				"internalType": "string",
				"name": "buyer_landID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "buyer_address",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "amount",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "transaction_status",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "transaction_hash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "timestamp",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
]
      var account;
      window.addEventListener("load", async () => {
        // Modern DApp browsers
        if (window.ethereum) {
          window.web3 = new Web3(ethereum);

          // To prevent the page reloading when the MetaMask network changes
          ethereum.autoRefreshOnNetworkChange = false;

          // To Capture the account details from MetaMask
          const accounts = await ethereum.enable();
          account = accounts[0];
        }

        // Non-DApp browsers
        else {
          alert("Non-Ethereum browser detected. Please install MetaMask");
        }
      });

      async function PrintAllTransactionDetails() {
        // Initialize the contract instance
        const contract = new web3.eth.Contract(abi, contractAddress, {
          from: account,
        });
        const usersTableBody = document.getElementById("usersTableBody");
        usersTableBody.innerHTML = ""; // Clear existing table rows

        // Call the smart contract to get all transaction Details
        const alltrans= await contract.methods.fetchDetails().call();
        
        // Iterate over each transaction and add them to the table
        alltrans.forEach((trans) => {
          const row = document.createElement("tr");
          // Add trans details to the row
          row.innerHTML = `
            <td>${trans.sellerName}</td>
            <td> <a class="btn btn-primary " href="mailto:>${trans.sellerEmail}?subject=
                  Mail from Land Registry Using Blockchain to confirm :Sale of Transferred Amount to Buyer.
				  ">Email</a>  
			 </td>
            <td>${trans.sellerPhone}</td>
            <td>${trans.sellerAdhar}</td>
            <td>${trans.sellerLandId}</td>
            <td>${trans.sellerAddress}</td>
            <td>${trans.buyerName}</td>
            <td> <a class="btn btn-primary " href="mailto:>${trans.buyerEmail}?subject=
                  Mail from Land Registry Using Blockchain to confirm :Sale of Transferred Amount to Buyer.
				  ">Email</a>  
			 </td>
    
            <td>${trans.buyerPhone}</td>
            <td>${trans.buyerAdhar}</td>
            <td>${trans.buyerLandId}</td>
            <td>${trans.buyerAddress}</td>
            <td>${trans.amount/1e18}ETH</td>
            <td>${trans.transaction_hash}</td>
            <td>${trans.transactionStatus}</td>
			<td>${trans.timestamp}</td>
			<td>${trans.ownership_status}</td>
            <td>
			<button class="btn bg-danger" onclick="changeownership('${trans.sellerLandId}', '${trans.buyerLandId}')">
			Ownership</button>

            <td>

        `;

          // Append the row to the table body
          usersTableBody.appendChild(row);
        });
      }
      async function changeownership(sender,receiver)
      {
		  
         // Initialize the contract instance
         const contract = new web3.eth.Contract(abi, contractAddress, {
          from: account,
        });
        try {
          // Metamask will prompt the user to sign the transaction
          const result = await contract.methods.changeOwnership(sender,receiver).send();

          // Check transaction status
        if (result.status === true) {
           alert("Ownership changed successfully")}
		   PrintAllTransactionDetails();
		  

        } catch (error) {
			// console.log(sender,receiver)
          alert(error.message)
       
        }
		
      }

      // Load all users when the page loads
      window.addEventListener("load", async () => {
        PrintAllTransactionDetails();
      });
    </script>
  </body>
</html>
