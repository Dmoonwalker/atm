class ATM:
    def __init__(self):
        self.balance = 0
        self.pin = "1234"  # Default PIN for demonstration
        self.is_authenticated = False

    def authenticate(self, pin):
        if pin == self.pin:
            self.is_authenticated = True
            return True
        return False

    def check_balance(self):
        if not self.is_authenticated:
            return "Please authenticate first"
        return f"Current balance: ${self.balance:.2f}"

    def deposit(self, amount):
        if not self.is_authenticated:
            return "Please authenticate first"
        if amount <= 0:
            return "Invalid amount. Please enter a positive number."
        self.balance += amount
        return f"Deposited ${amount:.2f}. New balance: ${self.balance:.2f}"

    def withdraw(self, amount):
        if not self.is_authenticated:
            return "Please authenticate first"
        if amount <= 0:
            return "Invalid amount. Please enter a positive number."
        if amount > self.balance:
            return "Insufficient funds"
        self.balance -= amount
        return f"Withdrawn ${amount:.2f}. New balance: ${self.balance:.2f}"

def main():
    atm = ATM()
    
    while True:
        print("\n=== ATM System ===")
        print("1. Authenticate")
        print("2. Check Balance")
        print("3. Deposit")
        print("4. Withdraw")
        print("5. Exit")
        
        choice = input("\nEnter your choice (1-5): ")
        
        if choice == "1":
            pin = input("Enter PIN: ")
            if atm.authenticate(pin):
                print("Authentication successful!")
            else:
                print("Invalid PIN!")
        
        elif choice == "2":
            print(atm.check_balance())
        
        elif choice == "3":
            try:
                amount = float(input("Enter amount to deposit: $"))
                print(atm.deposit(amount))
            except ValueError:
                print("Invalid input. Please enter a valid number.")
        
        elif choice == "4":
            try:
                amount = float(input("Enter amount to withdraw: $"))
                print(atm.withdraw(amount))
            except ValueError:
                print("Invalid input. Please enter a valid number.")
        
        elif choice == "5":
            print("Thank you for using our ATM. Goodbye!")
            break
        
        else:
            print("Invalid choice. Please try again.")

if __name__ == "__main__":
    main() 